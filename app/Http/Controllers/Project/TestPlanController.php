<?php

namespace App\Http\Controllers\Project;

use Illuminate\Http\Request;

use Redirect;
use Input;
use App\Http\Requests;
use App\Http\Controllers\SingleFormController;
use App\Http\Models\Operation;
use App\Http\Models\Project\TestPlan;
use App\Http\Models\Project\TestCase;
use App\Http\Models\Project\Version;
use App\Http\Models\Project\TestResult;

class TestPlanController extends ProjectBaseController
{
    public function __construct()
    {
        $this->model = 'App\Http\Models\Project\TestPlan';
        $this->fields_show = ['id' ,'test_plan_name', 'version_name', 'updated_at'];
        $this->fields_edit = ['test_plan_name', 'version_name'];

        parent::__construct();
    }

    protected function viewShare()
    {
        $this->add_enum_dict(
            "version_name",
            "version_id", 
            Version::dict(-1));

        parent::viewShare();
    }

    public function genTestPlanOp()
    {
        $op_test_result = new Operation(gen_action("getTestPlanSummary"),
            "summary");
        $op_test_result->style_icon = "list";

        $op_view_test_result = new Operation(gen_action("getImportTestCase"),
            "import");
        $op_view_test_result->style_icon = "import";

        $op_exec_test_result = new Operation(gen_action("getExecuteTestCase"),
            "execute");
        $op_exec_test_result->style_icon = "play";
        $op_exec_test_result->style_type = 'primary';

        $op_edit = new Operation(gen_action("getEdit"), "edit");
        $op_edit->style_type = 'default';

        $this->operations = [ 
            $op_test_result,
            $op_view_test_result,
            $op_exec_test_result,
            $op_edit,
            new Operation(gen_action("getDestroy"), "destroy"),
        ];
    }

    public function getIndex()
    {
        if ($this->version)
        {
            $this->index_filters["version_id"] = [
                "type"=>"eq", 
                "value"=>$this->version->id,
            ];
        }

        $this->genTestPlanOp();
        return parent::getIndex();
    }

    public function getTestPlanSummary()
    {
        $test_plan_id = $this->inputId("id");
        $test_plan = TestPlan::find($test_plan_id);
        $test_result_count = TestResult::where("test_plan_id", $test_plan_id)->count();

        $passed_results= TestResult::where("test_plan_id", $test_plan_id)->succeed()->get();
        $failed_results = TestResult::where("test_plan_id", $test_plan_id)->failed()->get();

        return $this->viewMake("project.test_plan_summary",
            [
                'model'=>$test_plan,
                'test_result_count'=>$test_result_count,
                'passed_results'=>$passed_results,
                'failed_results'=>$failed_results,
            ]);
    }

    public function getImportTestCase()
    {
        $test_plan_id = $this->inputId("id");
        $test_plan = TestPlan::find($test_plan_id);

        $exists_test_case = TestResult::where("test_plan_id", $test_plan_id)->get();
        $exists_test_case_ids = [];
        foreach($exists_test_case as $test_case)
        {
            $exists_test_case_ids[] = $test_case->id;
        }

        $storys = $test_plan->version->storys;

        foreach($storys as $story)
        {
            foreach ($story->test_cases as $test_case)
            {
                if (in_array($test_case->id, $exists_test_case_ids))
                {
                    continue;
                }
                
                $test_result = new TestResult;
                $test_result->test_plan_id = $test_plan_id;
                $test_result->test_case_id = $test_case->id;
                $test_result->success = 0;
                $test_result->save();
            }
        }

        return Redirect::To(action($this->controller."@getIndex"));

    }

    public function getExecuteTestCase()
    {
        $test_plan_id = $this->inputId("id");

        $from_test_result_id = $this->inputId("test_result_id");
        if($from_test_result_id != null)
        {
            $test_result = TestResult::find($from_test_result_id);
            $test_result->success = Input::get("success", "0")== ""?1:-1;
            $test_result->remark = Input::get("remark");
            $test_result->save();
            $test_plan_id = $test_result->test_plan_id;
        }
        else
        {
            $from_test_result_id = 0;
        }

        $next_test_result = TestResult::where("test_plan_id", $test_plan_id)->where("id", '>', $from_test_result_id)->first();
        if ($next_test_result == null)
        {
            return Redirect::To(action_url("getTestPlanSummary", ["id"=>$test_plan_id]));
        }
        else
        {
            $test_case = $next_test_result->test_case;
            return $this->viewMake("project.execute_test_result", [
                'model'=>$next_test_result,
                'test_case'=>$test_case,
                ]);
        }
    }

    public function getUpdateTestResult()
    {
        $test_result_id = $this->inputId("id");

        $test_result = TestResult::find($test_result_id);
        $test_result->success = $test_result->success == 1 ? -1 : 1;
        $test_result->save();

        return Redirect::to(action_url("getTestPlanSummary", ["id"=>$test_result->test_plan_id]));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        return parent::getCreate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postStore()
    {
        //
        return parent::postStore();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getShow()
    {
        //
        return parent::getShow();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit()
    {
        //
        return parent::getEdit();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postUpdate()
    {
        //
        return parent::postUpdate();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postDestroy()
    {
        //
        return parent::postDestroy();
    }
}
