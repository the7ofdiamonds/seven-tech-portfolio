jQuery(document).ready(function ($) {
    const updateProjectURLsCount = () => {
        let projectURLIndex = document.querySelectorAll('#project_url').length;

        var newTask = `
            <div class="project-url" id="project_url">
                <input type="text" name="project_urls_list[${projectURLIndex}][name]" value="" placeholder="URL Name"/>
                <input type="text" name="project_urls_list[${projectURLIndex}][icon]" value="" placeholder="URL Icon" />
                <input type="url" name="project_urls_list[${projectURLIndex}][url]" value="" placeholder="URL" />
            </div>
        `;

        $('#project_urls_list').append(newTask);
    }

    $('#add_project_url_button').on('click', updateProjectURLsCount);

    const updateProjectVersionsCount = () => {
        let projectVersionIndex = document.querySelectorAll('#project_version').length;

        var newTask = `
        <div class="project-version" id="project_version">
            <input type="text" name="project_versions_list[${projectVersionIndex}][title]" value="" placeholder="Version Name"/>
            <input type="text" name="project_versions_list[${projectVersionIndex}][version]" value="" placeholder="Version Number" />
        </div>
    `;

        $('#project_versions_list').append(newTask);
    }

    $('#add_version_button').on('click', updateProjectVersionsCount);

    const updateDesignTaskCount = () => {
        let designTaskIndex = document.querySelectorAll('#design_task').length;

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

    const updateColorsCount = () => {
        let colorIndex = document.querySelectorAll('#color').length;

        var newTask = `
        <div class="color" id="color">
            <input type="text" name="colors_list[${colorIndex}][title]" value="" placeholder="Color Title"/>
            <input type="color" name="colors_list[${colorIndex}][color]" value="" />
        </div>
    `;

        $('#colors_list').append(newTask);
    }

    $('#add_color_button').on('click', updateColorsCount);

    const updateDevelopmentTaskCount = () => {
        let developmentTaskIndex = document.querySelectorAll('#development_task').length;

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
