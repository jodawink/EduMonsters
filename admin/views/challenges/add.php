<?php
if (!isset($challenge)) {
    $challenge = new Challenge();
}
?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Challenge
            </header>
            <div class="panel-body">

                <form class="form-horizontal" role="form" name="form" method="post" >

                    <div class="form-group">
                        <label for="name" class="col-lg-2 col-sm-2 control-label ">Title</label>
                        <div class="col-lg-10">
                            <?php HTML::textfield('name', 'form-control', null, null, false, $challenge->name); ?>
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



