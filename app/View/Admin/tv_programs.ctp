<?php $this->element('jqueryui'); ?>
<?php $this->element('admin_header'); ?>
        <script type="text/javascript">
            $(function(){
                $("#schedule-datepicker").datepicker({
                    "changeMonth" : true,
                    "changeYear" : true,
                    "minDate" : "-1m",
                    "maxDate" : "1m",
                    "dateFormat" : "yy-mm-dd",
                    "onSelect" : loadSelectedDateSched
                });
                var dateToday = getDateString();
                loadSelectedDateSched(dateToday);
            });
            function getDateString() {                
                var date = new Date();
                var year = date.getFullYear();
                var month = date.getMonth() + 1;
                var day = date.getDate();
                return (year + "-" + month + "-" + day);
            }
            function changeDateLabel(dateText) {
                $("#schedule-date-holder").empty();
                $("#schedule-date-holder").append("The schedules for " + dateText);
            }
            function loadSelectedDateSched(dateText) {
                changeDateLabel(dateText);
                $.get("<?php echo $this->Html->url("/admin/get_schedules_ajax", false); ?>",
                        { "sched_date" : dateText },
                        function(data){
                            $("#table-body-schedules *").empty();
                            $("#table-body-schedules").append(data);
                        },
                        "html");
            }
        </script>
<div>
    <h3>TV Programs</h3>
    <div class="row-fluid">
        <div class="span3">
            <ul>
                <li><?php echo $this->Html->link('Add TV programs', '/admin/add_tv_program'); ?></li>
                <li><?php echo $this->Html->link('Add program category', '/admin/add_tv_category'); ?></li>
                <li><?php echo $this->Html->link('Add program schedules', '/admin/add_schedules'); ?></li>
            </ul>
            <h4>Quick Add Program</h4>
            <div>
                <?php
                echo $this->Form->create('TvProgram', array(
                    'url' => array('controller' => 'admin', 'action' => 'add_tv_program')
                ));

                echo $this->Form->input('TvProgram.program_name');
                echo $this->Form->input('TvProgram.program_description', array(
                    'type' => 'textarea'
                ));
                echo $this->Form->select('TvProgram.tv_category_id', $categories_list);
                echo $this->Form->submit('Add', array(
                    'class' => 'btn'
                ));

                echo $this->Form->end();
                ?>
            </div>
        </div>
        <div class="span8">
            <input type="text" id="schedule-datepicker" />
            <strong><span id="schedule-date-holder"></span></strong>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Channel</th>
                        <th>Times</th>
                        <th>Program</th>
                    </tr>
                </thead>
                <tbody id="table-body-schedules">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>


