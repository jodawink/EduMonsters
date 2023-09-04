<div class="row">
    <div class="col-lg-12">
        <section class="panel">

            <header class="panel-heading">
                <h4>List of Challenges
                    <a href="<?php echo URL::abs('challenges/add'); ?>" class="btn btn-send pull-right">
                        <i class="fa fa-plus"></i> Create new challenge
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

                <?php if (count($challenges) == 0): ?>
                    <div class="emptyList">
                        There are no challenges here , do you want to create one ?
                        <a href="<?php echo URL::abs('challenges/add'); ?>" class="btn btn-send pull-right">
                            <i class="fa fa-plus"></i> Create new challenge
                        </a>
                    </div>
                <?php else: ?>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr id="title-line">
                                <th>id</th>
                                <th>name</th>
                                <th>Code</th>
                                <th>created at</th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($challenges as $key => $challenge): /* @var $challenge Challenge */ ?>
                                <tr>
                                    <td><?php echo $challenge->id; ?></td>
                                    <td><?php echo $challenge->name; ?></td>
                                    <td><?php echo $challenge->code; ?></td>
                                    <td><?php echo $challenge->created_at; ?></td>

                                    <td> 
                                        <a href="<?php echo URL::abs('challenges/edit-stage/' . $challenge->id); ?>" class="btn btn-send btn-xs">
                                            edit levels
                                        </a>
                                        <a href="<?php echo URL::abs('challenges/edit/' . $challenge->id); ?>" class="btn btn-success btn-xs">
                                            edit
                                        </a>
                                        <a onclick="return confirm('Are you sure?');" href="<?php echo URL::abs('challenges/delete/' . $challenge->id); ?>" class="btn btn-danger btn-xs">
                                            delete
                                        </a>
                                    </td>
                                </tr>   
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

            </div>
        </section>
    </div>
</div>
