<?php
if (!isset($challenge)) {
    $challenge = new Challenge();
}
?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading" style="padding: 20px;">
                <a href="<?php echo URL::abs('challenges'); ?>" >Challenges </a> > <span><?php echo $challenge->name; ?></span>
                <?php if (count($stages) != 0): ?>
                    <a onclick="return onCreateStage();" href="#" class="btn btn-send pull-right">
                        <i class="fa fa-plus"></i> Add new level
                    </a>
                <?php endif; ?>
            </header>
            <div class="panel-body">

                <?php if (count($stages) <= 0): ?>
                    <div class="emptyList">
                        This challenge does not have any levels , do you want to create one ?
                        <a onclick="return onCreateStage();" href="#" class="btn btn-success">
                            <i class="fa fa-plus"></i> Create new level
                        </a>
                    </div>
                <?php else: ?>
                <?php endif; ?>

            </div>

            <div class="panel-body">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="padding-bottom: 10px;">
                            Challenge 
                        </div>
                        <div class="card-body">
                            <div id="tree"></div>
                        </div>
                    </div>
                </div>
            </div>


        </section>

    </div>
</div>

<!-- Modal Stage -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Create a level</h4>
            </div>
            <form action="<?php echo URL::abs('challenges/edit-stage/' . $challenge->id); ?>" method="post">

                <div class="modal-body">
                    <div>
                        <p>Level name</p>
                        <input required id="stage-name" type="text" name="name" placeholder="Level name" class="form-control placeholder-no-fix">
                    </div>
                    
                    <div style="margin-top: 10px;">
                        <p>Number correct answers to advance</p>
                        <input required type="text" name="corect_questions" class="form-control placeholder-no-fix">
                    </div>

                    <div style="margin-top: 10px;">
                        <p>Number of required questions</p>
                        <input required type="text" name="required_questions" class="form-control placeholder-no-fix">
                    </div>

                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                    <button class="btn btn-success" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal -->

<!-- Modal Set -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="addSet" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add a set</h4>
            </div>
            <div class="modal-body">
                <div>
                    <p>Choose a set</p>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th colspan="2" >Set Name</th>
                            </tr>
                        </thead>
                        <tbody id="sets" >
                            <tr>
                                <td> <input type="checkbox" /> </td>
                                <td> Addition</td>
                            </tr>
                            <tr>
                                <td> <input type="checkbox" /> </td>
                                <td> Subruction</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <input type="hidden" id="add-set-stage-id" />


            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                <button onclick="onAddSetModalClicked();" class="btn btn-success" type="button">Add</button>
            </div>

        </div>
    </div>
</div>
<!-- modal -->

<!-- Modal Edit SET -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="setModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Set</h4>
            </div>

            <div class="modal-body">
                <div>
                    <p>Set name</p>
                    <input required id="set-name" type="text" name="name" placeholder="Set name" class="form-control placeholder-no-fix" />
                    <input type="hidden" id="set-id" />
                    <input type="hidden" id="set-stage-id" />
                </div>
            </div>

            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                <button onclick="onSaveEditSet();" class="btn btn-success" type="button">Save</button>
            </div>

        </div>
    </div>
</div>
<!-- modal -->

<!-- Modal Stage -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="stageModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit level</h4>
            </div>

            <div class="modal-body">
                <div>
                    <p>Level name</p>
                    <input autofocus required id="edit-stage-name" type="text" name="name" placeholder="Level name" class="form-control placeholder-no-fix">
                </div>
                
                <div style="margin-top: 10px;">
                    <p>Number correct answers to advance</p>
                    <input required type="text" id="edit-stage-corect" name="cored_questions" class="form-control placeholder-no-fix">
                </div>
                
                <div style="margin-top: 10px;">
                    <p>Number of required questions</p>
                    <input required type="text" id="edit-stage-required" name="required_questions" class="form-control placeholder-no-fix">
                </div>
            </div>
            <div class="modal-footer">
                <input id="edit-stage-id" type="hidden" />
                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                <button onclick="onEditStageSave()" class="btn btn-success" type="button">Save</button>
            </div>

        </div>
    </div>
</div>
<!-- modal -->

<!-- Modal Stage -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="questionModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Question</h4>
            </div>


            <div class="modal-body">
                <div>
                    <p>Question</p>
                    <textarea autofocus="autofocus" required id="question-content" type="text" name="question" placeholder="Question Text" class="form-control placeholder-no-fix"></textarea>
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

                <div style="margin-top: 10px;">
                    <p>Answers</p>

                    <div class="form-body col-lg-6 q-container">
                        <p>Correct answer</p>
                        <input required type="text" id="a-1" name="c1" class="form-control placeholder-no-fix correct">
                    </div>

                    <div class="form-body col-lg-6 q-container">
                        <p>Wrong answer</p>
                        <input required type="text" id="a-2" name="c2" class="form-control placeholder-no-fix wrong">
                    </div>



                    <div class="form-body col-lg-6 q-container">
                        <p>Wrong answer</p>
                        <input required type="text" id="a-3" name="c2" class="form-control placeholder-no-fix wrong">
                    </div>

                    <div class="form-body col-lg-6 q-container" style="margin-bottom: 10px">
                        <p>Wrong answer</p>
                        <input required type="text" id="a-4" name="c4" class="form-control placeholder-no-fix wrong">
                    </div>

                </div>

                <div style="margin-top: 20px;">
                    <p>Difficulty</p>
                    <?php echo HTML::select([1 => 'easy', 2 => 'medium', 3 => 'hard'], 'question-difficulty', 1, 'form-control'); ?>
                </div>

            </div>
            <div class="modal-footer">
                <input id="question-id" type="hidden" />
                <input id="question-set-id" type="hidden" />
                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                <button onclick="onQuestionSaveClicked()" class="btn btn-success" type="button">Save</button>
            </div>

        </div>
    </div>
</div>
<!-- modal -->


<script>

    function onCreateStage() {
        // Trigger Modal view
        $("#myModal").modal('show');
        return false;
    }

    $('#myModal').on('shown.bs.modal', function () {
        $('#stage-name').focus();
    });

</script>


<script>

    var challenge_id = <?php echo json_decode($challenge->id) ?>;

    // https://github.com/jonmiles/bootstrap-treeview

    var td = JSON.parse(<?php echo json_encode($tree); ?>);

    function toTreeData(td) {
        var challange_id = Object.keys(td);
        var challange = td[challange_id];

        const treeData = [];

        for (let key in challange.stages) {
            if (challange.stages.hasOwnProperty(key)) {
                var stage = challange.stages[key];
                var stageObject = createStageNode(stage);

                for (let set_key in stage.sets) {
                    if (stage.sets.hasOwnProperty(set_key)) {
                        var set = stage.sets[set_key];
                        var setObject = createSetNode(stage, set);
                        stageObject.nodes.push(setObject);
                    }
                }

                treeData.push(stageObject);
            }
        }

        return treeData;
    }

    var treeData = toTreeData(td);

    function rebuildTree() {
        $('#tree').treeview({data: treeData,
            onNodeCollapsed: function (event, node) {
                updateTreeStateData(node);
            },
            onNodeExpanded: function (event, node) {
                updateTreeStateData(node);
            }});
    }

    rebuildTree();

    //////////// Stage Methods

    var setsList = [];

    getAllSets(function (list) {
        setsList = list;
    });

    function onAddSetModalClicked() {
        $("#addSet").modal('hide');
        var stageIdInput = document.getElementById('add-set-stage-id');
        var stageId = stageIdInput.value;

        var setsTableBody = document.getElementById('sets');
        var inputs = setsTableBody.querySelectorAll('input[type=checkbox]:is(:checked)');
        var ids = [];

        for (var i = 0; i < inputs.length; i++) {
            var inp = inputs[i];
            ids.push(inp.dataset.id);

        }

        if (ids.length) {
            var postObject = {stageId, ids};
            ajaxPost('challenges/add-sets', postObject, function (response) {

                let addedSets = response;
                var sets = [];

                let stage = findTreeDataNode(treeData, 'stage', stageId);

                for (var i = 0; i < addedSets.length; i++) {
                    let setId = addedSets[i];

                    for (var j = 0; j < setsList.length; j++) {
                        let set = setsList[j];

                        if (set.id == setId) {
                            addSet(stage, set);
                            // sets.push(set);
                        }
                    }
                }


            });
        }
    }

    function toggleCheckbox(id) {
        var checkbox = document.getElementById(id);
        if (checkbox.checked) {
            checkbox.checked = false;
        } else {
            checkbox.checked = true;
        }
    }

    function onCheckBox(e) {
        e.stopPropagation();
    }

    function getAllSets(callback) {
        ajaxPost('sets/get', null, function (response) {
            if (callback) {
                callback(response);
            }
        });
    }

    function onAddSet(e, stageID) {
        $("#addSet").modal('show');

        var stageIdInput = document.getElementById('add-set-stage-id');
        stageIdInput.value = stageID;

        if (!setsList || setsList.length <= 0) {
            var setsTableBody = document.getElementById('sets');
            setsTableBody.innerHTML = '';
            getAllSets(setListToModal);
        } else {
            setListToModal(setsList);
        }

        e.stopPropagation();
        return false;
    }

    function setListToModal(list) {
        var setsTableBody = document.getElementById('sets');
        var body = list.map(itm => {
            return `<tr style="cursor:pointer;" onclick="toggleCheckbox('set-row-${itm.id}');" >
                                <td> <input onclick="onCheckBox(event)" id="set-row-${itm.id}" data-id="${itm.id}" type="checkbox" /> </td>
                                <td> ${itm.title} </td>
                            </tr>`;
        });

        setsTableBody.innerHTML = body.join('');
    }

    function onEditStage(e, stageID) {

        $("#stageModal").modal('show');

        for (var i = 0; i < treeData.length; i++) {
            var stage = treeData[i];
            if (stage.id == stageID) {
                document.getElementById('edit-stage-id').value = stageID;
                document.getElementById('edit-stage-name').value = stage.name;
                document.getElementById('edit-stage-required').value = stage.required_questions;
                document.getElementById('edit-stage-corect').value = stage.corect_questions;
                break;
            }
        }

        e.stopPropagation();

        // onEditStageSave
        return false;
    }

    function onEditStageSave() {
        var stage_id = document.getElementById('edit-stage-id').value;
        var name = document.getElementById('edit-stage-name').value;
        var required_questions = document.getElementById('edit-stage-required').value;
        var corect_questions = document.getElementById('edit-stage-corect').value;

        $("#stageModal").modal('hide');

        ajaxPost('challenges/edit-stage-data', {stage_id, name, required_questions , corect_questions}, function (response) {

        });

        for (var i = 0; i < treeData.length; i++) {
            var stage = treeData[i];

            if (stage.id == stage_id) {
                stage.required_questions = required_questions;
                stage.corect_questions = corect_questions;
                stage.name = name;

                var newStageData = createStageNode(stage);
                newStageData.nodes = stage.nodes;
                treeData[i] = newStageData;

                rebuildTree();
                break;
            }
        }
    }

    function onDeleteStage(e, stage_id) {
        for (var i = 0; i < treeData.length; i++) {
            var stageData = treeData[i];
            if (stageData.id == stage_id) {
                treeData.splice(i, 1);
                rebuildTree();
                break;
            }
        }

        ajaxPost('challenges/delete-stage', {stage_id, challenge_id}, function (response) {
            console.log("delete", response);
        });

        e.stopPropagation();
        return false;
    }

    ////////// Set methods

    function onAddQuestionShow(e, setID) {
        document.getElementById('question-id').value = '';
        document.getElementById('question-set-id').value = setID;

        $("#questionModal").modal('show');
        e.stopPropagation();
        return false;
    }

    function onQuestionSaveClicked() {
        var set_id = document.getElementById('question-set-id').value;
        var question_id = document.getElementById('question-id').value;

        var content = document.getElementById('question-content').value;
        var difficulty = document.getElementById('question-difficulty').value;
        var a1 = document.getElementById('a-1').value;
        var a2 = document.getElementById('a-2').value;
        var a3 = document.getElementById('a-3').value;
        var a4 = document.getElementById('a-4').value;

        var data = {
            question_id,
            set_id,
            content,
            difficulty,
            answers: [
                a1, a2, a3, a4
            ]
        };

        ajaxPost('challenges/add-question', data, function (response) {
            if (setsList && setsList.length) {

                if (set_id) {
                    for (var i = 0; i < setsList.length; i++) {
                        var set = setsList[i];
                        if (set.id == set_id) {
                            set.questions.push(response);
                            updateTreeDataSetNodes(treeData, set);
                            break;
                        }
                    }
                } else {
                    if (setsList && setsList.length) {
                        for (var i = 0; i < setsList.length; i++) {
                            var set = setsList[i];
                            for (var j = 0; j < set.questions.length; j++) {
                                var q = set.questions[j];
                                if (q.id == question_id) {
                                    q.answers = JSON.stringify(data.answers);
                                    q.content = data.content;
                                    q.difficulty = data.difficulty;
                                    updateTreeDataSetNodes(treeData, set);
                                    break;
                                }
                            }
                        }
                    }
                }


                rebuildTree();
            }
        });

        $('#questionModal').modal('hide');
    }

    function onEditSet(e, stage_id, setID) {
        $('#setModal').modal('show');

        // check the sets list
        if (setsList && setsList.length) {
            for (var i = 0; i < setsList.length; i++) {
                var set = setsList[i];
                if (set.id == setID) {
                    document.getElementById('set-name').value = set.title;
                    break;
                }
            }
        }

        // set-name
        // set-id
        document.getElementById('set-id').value = setID;
        document.getElementById('set-stage-id').value = stage_id;

        e.stopPropagation();
        return false;
    }

    function onSaveEditSet() {
        var set_id = document.getElementById('set-id').value;
        var name = document.getElementById('set-name').value;
        var stage_id = document.getElementById('set-stage-id').value;

        ajaxPost('challenges/edit-set', {set_id, name}, function (response) {

        });

        if (setsList && setsList.length) {
            for (var i = 0; i < setsList.length; i++) {
                var set = setsList[i];
                if (set.id == set_id) {
                    set.title = name;
                    updateTreeDataSetNodes(treeData, set);
                    break;
                }
            }

            rebuildTree();
        }

        $('#setModal').modal('hide');
    }

    function onDeleteSet(e, stage_id, set_id) {

        ajaxPost('challenges/delete-sets', {stage_id, set_id}, function (response) {
            if (response && response.msg === 'success') {
                // update tree
                // $('#tree').treeview('remove' ,nodeID);
            }
        });
        e.stopPropagation();

        var stageNode = findTreeDataNode(treeData, 'stage', stage_id);


        for (var i = 0; i < stageNode.nodes.length; i++) {
            let node = stageNode.nodes[i];
            if (node.id == set_id) {
                stageNode.nodes.splice(i, 1);
                rebuildTree();
                break;
            }
        }

        return false;
    }

    ////////////////// Question methods

    function onEditQuestionShow(e, questionID) {

        $("#questionModal").modal('show');

        document.getElementById('question-id').value = questionID;
        document.getElementById('question-set-id').value = '';

        var q = getQuestionData(questionID);

        document.getElementById('question-content').value = q.content;
        document.getElementById('question-difficulty').value = q.difficulty;

        if (q.answers) {
            var answers = JSON.parse(q.answers);
            if (answers) {
                document.getElementById('a-1').value = answers[0];
                document.getElementById('a-2').value = answers[1];
                document.getElementById('a-3').value = answers[2];
                document.getElementById('a-4').value = answers[3];
            }
        } else {
            document.getElementById('a-1').value = '';
            document.getElementById('a-2').value = '';
            document.getElementById('a-3').value = '';
            document.getElementById('a-4').value = '';
        }

        e.stopPropagation();
        return false;
    }

    function getQuestionData(question_id) {
        if (setsList && setsList.length) {
            for (var i = 0; i < setsList.length; i++) {
                var set = setsList[i];
                for (var j = 0; j < set.questions.length; j++) {
                    var q = set.questions[j];
                    if (q.id == question_id) {
                        return q;
                    }
                }
            }
        }
    }

    function onDeleteQuestion(e, question_id) {
        var data = {question_id};
        ajaxPost('challenges/delete-question', data, function (response) {


            if (setsList && setsList.length) {
                for (var i = 0; i < setsList.length; i++) {
                    var set = setsList[i];
                    for (var j = 0; j < set.questions.length; j++) {
                        var q = set.questions[j];
                        if (q.id == question_id) {
                            set.questions.splice(j, i);
                            updateTreeDataSetNodes(treeData, set);
                            break;
                        }
                    }
                }

                rebuildTree();
            }

        });
        e.stopPropagation();
        return false;
    }

    ///////////////////////////////////

    function serialize(obj, prefix) {
        var str = [];
        for (var p in obj) {
            if (obj.hasOwnProperty(p)) {
                var k = prefix ? prefix + "[" + p + "]" : p, v = obj[p];
                str.push(typeof v == "object" ?
                        serialize(v, k) :
                        encodeURIComponent(k) + "=" + encodeURIComponent(v));
            }
        }
        return str.join("&");
    }

    function createAjax() {
        var xhttp;
        if (window.XMLHttpRequest) {
            xhttp = new XMLHttpRequest();
        } else {
            xhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        return xhttp;
    }

    function ajaxGet(url, callback, headers) {

        var xhttp = createAjax();

        if (headers) {

            for (var prop in headers) {
                if (Object.prototype.hasOwnProperty.call(headers, prop)) {
                    xhttp.setRequestHeader(prop, headers[prop]);
                }
            }
        }

        xhttp.onreadystatechange = function () {

            if (xhttp.readyState === 4) {
                if (xhttp.status === 200) {
                    var ct = xhttp.getResponseHeader("content-type") || "";
                    if (ct.indexOf('json') > -1) {
                        callback(JSON.parse(xhttp.responseText), xhttp);
                    } else {
                        callback(xhttp.responseText, xhttp);
                    }
                } else {
                    if (callback) {
                        callback(null, xhttp);
                    }
                }
            }
        };

        xhttp.open("GET", url, true);
        xhttp.send();

    }

    function ajaxPost(url, data, callback, headers) {


        var xhttp = createAjax();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState === 4) {
                if (xhttp.status === 200) {
                    if (callback) {

                        var ct = xhttp.getResponseHeader("content-type") || "";
                        if (ct.indexOf('json') > -1) {
                            var response = xhttp.responseText;
                            try {
                                response = JSON.parse(xhttp.responseText);
                            } catch (e) {
                                response = xhttp.responseText;
                            }
                            callback(response, xhttp);
                        } else {
                            callback(xhttp.responseText, xhttp);
                        }
                    }
                } else {
                    if (callback) {
                        callback(null, xhttp);
                    }
                }
            }
        };

        xhttp.open("POST", base_url + url, true);

        if (headers) {

            for (var prop in headers) {
                if (Object.prototype.hasOwnProperty.call(headers, prop)) {
                    xhttp.setRequestHeader(prop, headers[prop]);
                }
            }
        } else {
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        }

        if (data instanceof FormData) {
            xhttp.send(data);
        } else {
            var data_string = serialize(data);
            xhttp.send(data_string);
        }

    }

    function updateTreeStateData(node) {
        findChildNodes(node, treeData);
    }

    function findChildNodes(node, nodes) {
        for (var i = 0; i < nodes.length; i++) {
            var n = nodes[i];
            if (n.uID === node.uID) {
                n.state = node.state;
                return;
            }
            if (n.nodes) {
                findChildNodes(node, n.nodes);
            }
        }
    }

    function findTreeDataNode(nodes, dataType, id) {
        for (var i = 0; i < nodes.length; i++) {
            var n = nodes[i];
            if (n.dataType == dataType && n.id == id) {
                return n;
            }
            if (n.nodes) {
                findTreeDataNode(n.nodes, dataType, id);
            }
        }
    }

    function updateTreeDataSetNodes(nodes, setData) {
        for (var i = 0; i < nodes.length; i++) {
            var n = nodes[i];
            if (n.dataType == 'set' && n.id == setData.id) {
                // Replace set Data here
                var newSet = createSetNode({id: n.stage_id}, setData);
                newSet.state = n.state;
                nodes[i] = newSet;
                break;
            }

            if (n.nodes) {
                updateTreeDataSetNodes(n.nodes, setData);
            }
        }
    }

    function addSet(stage, set) {
        let setNode = createSetNode(stage, set);
        stage.nodes.push(setNode);
        rebuildTree();
    }

    function createStageNode(stage) {
        return {
            text: ` ${stage.name} - <span style='font-weight:bold;'>${stage.corect_questions}/${stage.required_questions}<span> <div class='btn btn-xs btn-danger pull-right' style='margin-left: 10px' onclick='onDeleteStage(event , ${stage.id})' > delete </div> <div class='btn btn-xs btn-success pull-right' style='margin-left: 10px' onclick='onEditStage(event , ${stage.id})' > edit </div> <div class='btn btn-xs btn-send pull-right' style='margin-left: 10px' onclick='onAddSet(event , ${stage.id})' > add set </div>`,
            backColor: "#FFFFFF",
            selectable: false,
            state: {
                expanded: true,
            },
            nodes: [],
            dataType: 'stage',
            id: stage.id,
            name: stage.name,
            required_questions: stage.required_questions,
            corect_questions: stage.corect_questions,
            uID: 'stage-' + stage.id
        };
    }

    function createSetNode(stage, set) {
        var setNode = {
            text: ` ${set.name || set.title} <div class='btn btn-xs btn-danger pull-right' style='margin-left: 10px' onclick='onDeleteSet(event , ${stage.id},${set.id})' > delete </div>  <div class='btn btn-xs btn-success pull-right' style='margin-left: 10px' onclick='onEditSet(event ,${stage.id}, ${set.id})' > edit </div> <div class='btn btn-xs btn-send pull-right' style='margin-left: 10px' onclick='onAddQuestionShow(event , ${set.id})' > add question </div>`,
            backColor: "#FFFFFF",
            selectable: false,
            state: {
                expanded: false,
            },
            nodes: [],
            dataType: 'set',
            id: set.id,
            uID: 'set-' + stage.id + '-' + set.id,
            stage_id: stage.id
        };

        for (var i = 0; i < set.questions.length; i++) {
            var question = set.questions[i];
            var qNode = createQuestionNode(question);
            setNode.nodes.push(qNode);
        }

        return setNode;
    }

    function createQuestionNode(question) {
        return {
            text: ` ${question.content} <div class='btn btn-xs btn-danger pull-right' style='margin-left: 10px' onclick='onDeleteQuestion(event , ${question.id})' > delete </div>  <div class='btn btn-xs btn-success pull-right' style='margin-left: 10px' onclick='onEditQuestionShow(event , ${question.id})' > edit </div> `,
            backColor: "#FFFFFF",
            selectable: false,
            icon: "glyphicon glyphicon-stop",
            dataType: 'question',
            id: question.id,
            uID: 'q-' + question.id,
            answers: question.answers,
            difficulty: question
        };
    }



</script>



