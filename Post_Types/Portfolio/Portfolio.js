jQuery(document).ready(function ($) {
    const updateDesignTaskCount = () => {
        let designTaskIndex = document.querySelectorAll('#design_task').length;
        console.log(designTaskIndex);

        var newTask = `
        <div class="task" id="design_task">
            <input type="checkbox" name="design_check_list[${designTaskIndex}][status]" value="checked" />
            <input type="text" name="design_check_list[${designTaskIndex}][name]" placeholder="Task Name" />
            <input type="text" name="design_check_list[${designTaskIndex}][time]" value="" placeholder="Time" />
        </div>
    `;

        $('#design_task_list').append(newTask);
    }

    $('#add_design_task_button').on('click', updateDesignTaskCount);

    const updateDevelopmentTaskCount = () => {
        let developmentTaskIndex = document.querySelectorAll('#development_task').length;
        console.log(developmentTaskIndex);

        var newTask = `
        <div class="task" id="development_task">
            <input type="checkbox" name="development_check_list[${developmentTaskIndex}][status]" value="checked" />
            <input type="text" name="development_check_list[${developmentTaskIndex}][name]" placeholder="Task Name" />
            <input type="text" name="development_check_list[${developmentTaskIndex}][time]" value="" placeholder="Time" />
        </div>
    `;

        $('#development_task_list').append(newTask);
    }

    $('#add_development_task_button').on('click', updateDevelopmentTaskCount);

    const updateDeliveryTaskCount = () => {
        let deliveryTaskIndex = document.querySelectorAll('#delivery_task').length;
        console.log(deliveryTaskIndex);

        var newTask = `
        <div class="task" id="delivery_task">
            <input type="checkbox" name="delivery_check_list[${deliveryTaskIndex}][status]" value="checked" />
            <input type="text" name="delivery_check_list[${deliveryTaskIndex}][name]" placeholder="Task Name" />
            <input type="text" name="delivery_check_list[${deliveryTaskIndex}][time]" value="" placeholder="Time" />
        </div>
    `;

        $('#delivery_task_list').append(newTask);
    }

    $('#add_delivery_task_button').on('click', updateDeliveryTaskCount);
});
