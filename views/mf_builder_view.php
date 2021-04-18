<div class="mf-container">
    <div class="mf-body">
        <div class="mf-sidebar">
            <ul class="mf-sidebar__navigation">
                <li class="mf-sidebar__nav-item js-active" data-sidebar-link="fields"><span>Fields</span></li>
                <li class="mf-sidebar__nav-item" data-sidebar-link="settings"><span>Settings</span></li>
            </ul>
            <div class="mf-sidebar__slide js-active" data-sidebar-slide="fields">
                <ul class="mf-sidebar__list">
                    <li class="mf-sidebar__item" data-sidebar-field="input"><span>Input</span></li>
                    <li class="mf-sidebar__item" data-sidebar-field="textarea"><span>Textarea</span></li>
                    <li class="mf-sidebar__item" data-sidebar-field="dropdown"><span>Dropdown</span></li>
                    <li class="mf-sidebar__item" data-sidebar-field="multiselect"><span>Multiselect</span></li>
                    <li class="mf-sidebar__item" data-sidebar-field="checkbox"><span>Checkbox</span></li>
                    <li class="mf-sidebar__item" data-sidebar-field="slider"><span>Slider</span></li>
                    <li class="mf-sidebar__item" data-sidebar-field="datetime"><span>Date</span></li>
                </ul>
            </div>
            <div class="mf-sidebar__slide" data-sidebar-slide="settings">
                <div class="mf-settings" data-settings-container>
                    <div class="mf-settings__field">
                        <div class="mf-settings__label">Label</div>
                        <div class="mf-settings__option">
                            <div class="mf-settings__title">
                                <input type="text" data-label placeholder="Label"/>
                            </div>
                        </div>
                    </div>

                    <div class="mf-settings__field">
                        <div class="mf-settings__label">Description</div>
                        <div class="mf-settings__option">
                            <div class="mf-settings__description">
                                <input type="text" data-description placeholder="Description"/>
                            </div>
                        </div>
                    </div>

                    <div class="mf-settings__field" data-ms="options">
                        <div class="mf-settings__label">Add Options</div>
                        <div class="mf-settings__option">
                            <div class="mf-settings__options">
                                <input type="text" data-ms="title" placeholder="Option title"/>
                                <input type="text" data-ms="value" placeholder="Option value" />
                                <span data-ms="add" class="dashicons dashicons-plus-alt"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mf-window">
            <div class="mf-window__container">
                <div class="mf-window__heading">
                    <div class="mf-window__headline" data-name/>Template</div>
                    <div class="mf-window__options">
                        <button class="mf-window__save" data-save>Save</button>
                    </div>
                </div>
                <div class="mf-window__body">
                    <form class="mf-window__form" data-mf-form method="POST">
                        <div data-container></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>