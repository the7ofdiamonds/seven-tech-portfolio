jQuery(document).ready(function ($) {
    var taskIndex = $('#design_task').length;

    $('#add-task-button').on('click', function () {
        var newTask = `
            <div class="task" id="design_task">
                <input type="checkbox" name="design_check_list[${taskIndex}][status]" value="checked" />
                <input type="text" name="design_check_list[${taskIndex}][name]" placeholder="Task Name" />
                <input type="text" name="design_check_list[${taskIndex}][time]" value="" placeholder="Time" />
            </div>
        `;

        $('.task-list').append(newTask);

        taskIndex++;
    });
});
