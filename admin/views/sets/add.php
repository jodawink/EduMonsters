<?php
if (!isset($set)) {
    $set = new Set();
}
?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Set
            </header>
            <div class="panel-body">
                <form class="form-horizontal" role="form" name="form" method="post" >

                    <div class="form-group">
                        <label for="title" class="col-lg-2 col-sm-2 control-label ">title</label>
                        <div class="col-lg-10">
                            <?php HTML::textfield('title', 'form-control', null, null, false, $set->title); ?>
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



