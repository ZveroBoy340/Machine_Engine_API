<div class="wpm_fitment">
    <div class="fitment-col">
        <select id="fitment-year">
            <option value="" selected="true" disabled="disabled" hidden>Year</option>
            <?php
                foreach($years['data'] as $year) {
                    echo "<option value='{$year['id']}'>{$year['value']}</option>";
                }
            ?>
        </select>
    </div>
    <div class="fitment-col">
        <select id="fitment-make" disabled>
            <option value="" selected="true" disabled="disabled" hidden>Make</option>
        </select>
    </div>
    <div class="fitment-col">
        <select id="fitment-model" disabled>
            <option value="" selected="true" disabled="disabled" hidden>Model</option>
        </select>
    </div>
    <div class="fitment-col">
        <select id="fitment-engine" disabled>
            <option value="" selected="true" disabled="disabled" hidden>Engine</option>
        </select>
    </div>
    <div class="fitment-col">
        <select id="fitment-transmission" disabled>
            <option value="" selected="true" disabled="disabled" hidden>Transmission</option>
        </select>
    </div>
</div>

<div class="preloader-filters">
    <div class="loader"></div>
</div>