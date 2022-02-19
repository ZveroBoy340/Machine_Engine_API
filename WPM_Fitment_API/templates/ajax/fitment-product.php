<?php
    if(count($products_data) > 0) {
        foreach($products_data as $product) {
            $attributes_product = [];
            $converter_codes = "";
            foreach($product['data'][0]['Attributes'] as $attribute) {
                if($attribute['Attribute'] != 'Converter Codes') {
                    $attributes_product[$attribute['Attribute']] = $attribute['Value'];
                } else {
                    $converter_codes = $attribute['Value'];
                }
            }

            ?>
            <div class="fitment-product">
                <div class="top-fitment-details">
                    <div class="left-title-fitment"><?php echo esc_html($product['data'][0]['PartNumber']); ?></div>
                    <div class="right-title-fitment"><?php if(isset($attributes_product['Converter Type'])) {echo esc_html($attributes_product['Converter Type']); } ?></div>
                </div>
                <div class="content-fitment">
                    <div class="header-fitment-product">
                        <div class="head-fitment-label">
                            <div class="head-label">Diameter</div>
                            <div class="head-label">Bolt Circle</div>
                        </div>
                        <div class="head-fitment-content">
                            <div class="head-item-content">
                                <div class="value-item-content">
                                    <?php if(isset($attributes_product['Converter Diameter'])) {echo esc_html($attributes_product['Converter Diameter']); } ?>
                                </div>
                                <div class="img-item-content">
                                    <?php if(isset($product['data'][0]['AssetList'][0]['Path'])) { ?>
                                        <a href="<?php echo esc_html($product['data'][0]['AssetList'][0]['Path']); ?>" class="lightzoom">
                                            <img src="<?php echo esc_html($product['data'][0]['AssetList'][0]['Path']); ?>" alt="">
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="head-item-content">
                                <div class="value-item-content">
                                    <?php if(isset($attributes_product['Bolt Circle'])) {echo esc_html($attributes_product['Bolt Circle']); } ?>
                                </div>
                                <div class="img-item-content">
                                    <?php if(isset($product['data'][0]['AssetList'][1]['Path'])) { ?>
                                        <a href="<?php echo esc_html($product['data'][0]['AssetList'][1]['Path']); ?>" class="lightzoom">
                                            <img src="<?php echo esc_html($product['data'][0]['AssetList'][1]['Path']); ?>" alt="">
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header-fitment-product">
                        <div class="head-fitment-label">
                            <div class="head-label">Mount</div>
                            <div class="head-label">Hub</div>
                            <div class="head-label">Pilot</div>
                            <div class="head-label">Spline</div>
                            <div class="head-label">Stall</div>
                        </div>
                        <div class="head-fitment-content">
                            <div class="head-item-content">
                                <div class="value-item-content">
                                    <?php if(isset($attributes_product['Mounting Type'])) {echo esc_html($attributes_product['Mounting Type']); } ?>
                                </div>
                            </div>
                            <div class="head-item-content">
                                <div class="value-item-content">
                                    <?php if(isset($attributes_product['Hub Type'])) {echo esc_html($attributes_product['Hub Type']); } ?>
                                </div>
                            </div>
                            <div class="head-item-content">
                                <div class="value-item-content">
                                    <?php if(isset($attributes_product['Pilot Diameter'])) {echo "<span>D: {$attributes_product['Pilot Diameter']}</span>"; } ?>
                                    <?php if(isset($attributes_product['Pilot Length'])) {echo "<span>L: {$attributes_product['Pilot Length']}</span>"; } ?>
                                </div>
                            </div>
                            <div class="head-item-content">
                                <div class="value-item-content">
                                    <?php if(isset($attributes_product['Spline Count'])) {echo esc_html($attributes_product['Spline Count']); } ?>
                                </div>
                            </div>
                            <div class="head-item-content">
                                <div class="value-item-content">
                                    <?php if(isset($attributes_product['Stall'])) {echo esc_html($attributes_product['Stall']); } ?>
                                </div>
                            </div>
                        </div>
                        <div class="side-fitment">
                            <?php if(isset($converter_codes)) { ?>
                                <div class="converter-codes"><b>Converter Codes</b>: <?php echo esc_html($converter_codes); ?></div>
                            <?php } ?>
                        </div>
                        <div class="other-attributes-fitment">
                            <ul>
                                <?php
                                $remove_attributes = ['Converter Diameter', 'Bolt Circle', 'Mounting Type', 'Hub Type', 'Pilot Diameter', 'Pilot Length', 'Spline Count', 'Stall', 'Converter Type'];

                                foreach($attributes_product as $title => $content) {
                                    if(!in_array($title, $remove_attributes)) {
                                        echo "<li><b>{$title}</b>: {$content}</li>";
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
<?php }
    } else {
        echo 'Nothing found';
} ?>