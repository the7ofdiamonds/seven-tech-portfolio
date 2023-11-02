jQuery(document).ready(function($) {
    var taskCount = 2; // Initialize with the existing task count

    $('#add-task-button').on('click', function() {
        taskCount++; // Increment the task count

        var newTask = `
            <div class="task">
                <input type="checkbox" name="design_check_list[task_${taskCount}]" value="completed" />
                <label for="task_${taskCount}">Task ${taskCount}</label>
                <input type="text" name="design_check_list[task_${taskCount}_time]" value="" />
            </div>
        `;

        $('.task-list').append(newTask);
    });
});