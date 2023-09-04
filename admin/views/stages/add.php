<?php
if (!isset($stage)) {
    $stage = new Stage();
}
?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Stage
            </header>
            <div class="panel-body">
                <form class="form-horizontal" role="form" name="form" method="post" >

                    <div class="form-group">
                        <label for="stage_name" class="col-lg-2 col-sm-2 control-label ">level name</label>
                        <div class="col-lg-10">
                            <?php HTML::textfield('stage_name', 'form-control', null, null, false, $stage->stage_name); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="corect_questions" class="col-lg-2 col-sm-2 control-label ">Correct Questions</label>
                        <div class="col-lg-10">
                            <?php HTML::textfield('corect_questions', 'form-control', null, null, false, $stage->corect_questions); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="required_questions" class="col-lg-2 col-sm-2 control-label ">Required Questions</label>
                        <div class="col-lg-10">
                            <?php HTML::textfield('required_questions', 'form-control', null, null, false, $stage->required_questions); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-send">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>



