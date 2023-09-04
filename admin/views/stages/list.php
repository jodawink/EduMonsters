<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <h4>List of Stages
                    <a href="<?php echo URL::abs('stages/add'); ?>" class="btn btn-send pull-right">
                        <i class="fa fa-plus"></i> Add
                    </a>
                </h4>
            </header>
            <div class="panel-body">



                <?php
                /* @var $paginator Paginator */
                if (isset($paginator)) {
                    $paginator->display();
                }
                ?>

                <table class="table table-striped table-advance table-hover">

                    <thead>
                        <tr id="title-line">
                            <th>id</th>
                            <th>level name</th>
                            <th>required_questions</th>
                            <th>created_at</th>

                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($stages as $key => $stage): /* @var $stage Stage */ ?>
                            <tr>
                                <td><?php echo $stage->id; ?></td>
                                <td><?php echo $stage->stage_name; ?></td>
                                <td><?php echo $stage->corect_questions . '/' . $stage->required_questions; ?></td>
                                <td><?php echo $stage->created_at; ?></td>

                                <td> 
                                    <a href="<?php echo URL::abs('stages/edit/' . $stage->id); ?>" class="btn btn-success btn-xs">
                                        edit
                                    </a>
                                    <a onclick="return confirm('Are you sure?');" href="<?php echo URL::abs('stages/delete/' . $stage->id); ?>" class="btn btn-danger btn-xs">
                                        delete
                                    </a>
                                </td>
                            </tr>   
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
