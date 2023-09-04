<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <h4>List of Sets
                    <a href="<?php echo URL::abs('sets/add'); ?>" class="btn btn-send pull-right">
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
                            <th>title</th>
                            <th>created_by</th>
                            <th>created_at</th>

                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sets as $key => $set): /* @var $set Set */ ?>
                            <tr>
                                <td><?php echo $set->id; ?></td>
                                <td><?php echo $set->title; ?></td>
                                <td><?php echo $set->created_by; ?></td>
                                <td><?php echo $set->created_at; ?></td>

                                <td> 
                                    <a href="<?php echo URL::abs('questions/manage/' . $set->id); ?>" class="btn btn-send btn-xs">
                                        manage questions
                                    </a>
                                    <a href="<?php echo URL::abs('sets/edit/' . $set->id); ?>" class="btn btn-success btn-xs">
                                        edit
                                    </a>
                                    <a onclick="return confirm('Are you sure?');" href="<?php echo URL::abs('sets/delete/' . $set->id); ?>" class="btn btn-danger btn-xs">
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
