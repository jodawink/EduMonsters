<?php
if (!isset($question)) {
    $question = new Question();
}
?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Question
            </header>
            <div class="panel-body">

                <form class="form-horizontal" role="form" name="form" method="post" >                    
                    <div class="form-group">
                        <label for="content" class="col-lg-2 col-sm-2 control-label ">content</label>
                        <div class="col-lg-10">
                            <?php HTML::textfield('content', 'form-control', null, null, false, $question->content); ?>
                        </div>
                    </div>

                    <style> 
                        .q-container {
                            padding: 5px
                        }

                        .correct {
                            background-color: #e4f5e6;
                        }

                        .wrong {
                            background-color: white;
                        }
                    </style>

                    <div class="form-group">
                        <label for="answers" class="col-lg-2 col-sm-2 control-label ">answers</label>
                        <div class="col-lg-10">

                            <?php $answers = $question->answers ? json_decode($question->answers) : ['', '', '', '']; ?>

                            <div class="form-body col-lg-6 q-container">
                                <p>Correct answer</p>
                                <input required type="text" id="a-1" name="answer1" value="<?php echo $answers[0]; ?>" class="form-control placeholder-no-fix correct">
                            </div>

                            <div class="form-body col-lg-6 q-container">
                                <p>Wrong answer</p>
                                <input required type="text" id="a-2" name="answer2" value="<?php echo $answers[1]; ?>" class="form-control placeholder-no-fix wrong">
                            </div>

                            <div class="form-body col-lg-6 q-container">
                                <p>Wrong answer</p>
                                <input required type="text" id="a-3" name="answer3" value="<?php echo $answers[2]; ?>" class="form-control placeholder-no-fix wrong">
                            </div>

                            <div class="form-body col-lg-6 q-container" style="margin-bottom: 10px">
                                <p>Wrong answer</p>
                                <input required type="text" id="a-4" name="answer4" value="<?php echo $answers[3]; ?>" class="form-control placeholder-no-fix wrong">
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="difficulty" class="col-lg-2 col-sm-2 control-label ">difficulty</label>
                        <div class="col-lg-10">
                            <?php HTML::textfield('difficulty', 'form-control', null, null, false, $question->difficulty); ?>
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



