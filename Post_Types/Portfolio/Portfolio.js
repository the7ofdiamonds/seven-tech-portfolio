jQuery(document).ready(function($) {
    $('#add-task-button').on('click', function() {
        var newTask = `
            <div class="task">
                <input type="checkbox" name="design_check_list[][status]" value="completed" checked />
                <input type="text" name="design_check_list[][name]" placeholder="Task Name" />
                <input type="text" name="design_check_list[][time]" value="" placeholder="Time" />
            </div>
        `;

        $('.task-list').append(newTask);
    });
});
