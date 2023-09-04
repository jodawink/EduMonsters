<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <h4>List of Questions in <b> <?php echo $set->title; ?> </b>
                    <a href="<?php echo URL::abs('questions/add/' . $set->id); ?>" class="btn btn-send pull-right">
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
                            <th>content</th>
                            <th>answers</th>
                            <th>difficulty</th>
                            <th>set_id</th>
                            <th>created_by</th>
                            <th>created_at</th>

                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($questions as $key => $question): /* @var $question Question */ ?>
                            <tr>
                                <td><?php echo $question->id; ?></td>
                                <td><?php echo $question->content; ?></td>
                                <td>
                                    <div>
                                        <?php echo implode(' </div><div> ', json_decode($question->answers)); ?>
                                    </div>
                                </td>
                                <td><?php echo $question->difficulty; ?></td>
                                <td><?php echo $question->set_id; ?></td>
                                <td><?php echo $question->created_by; ?></td>
                                <td><?php echo $question->created_at; ?></td>

                                <td> 
                                    <a href="<?php echo URL::abs('questions/edit/' . $question->id); ?>" class="btn btn-success btn-xs">
                                        edit
                                    </a>
                                    <a onclick="return confirm('Are you sure?');" href="<?php echo URL::abs('questions/delete/' . $question->id); ?>" class="btn btn-danger btn-xs">
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
