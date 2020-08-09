<?php
use \Concrete\Package\CommunityStore\Src\CommunityStore\Product\Product as StoreProduct;
?>

<div class="row">
    <div class="col-md-3 hidden-xs hidden-sm" style="position: -webkit-sticky;position: sticky;top: 0;">
        <p class="search-result text-uppercase">CATEGORIES</p>
        <?php foreach($categories as $cat){ ?>
            <div class="row" style="text-align: left;padding-left: 25px; overflow:hidden;">
                <a href="<?= Core::make('helper/navigation')->getLinkToCollection($cat) ?>"><?= strtoupper(Loader::helper('text')->entities($cat->getCollectionName())); ?> </a>
            </div>
        <?php } ?>
        <?php if(count($categories) <= 0){ ?>
            <div class="row"> No Categories </div>
        <?php } ?>
            
        <p class="search-result text-uppercase" style="margin-top: 1.5em;">Brands</p>
        <?php foreach($sortedGroupList as $brand){ ?>
        
            <div class="row" style="text-align: left;padding-left: 25px; overflow:hidden;">
                <a href="" onclick="<?= 'suggestSearch(\''. str_replace("'", "\'", $brand['groupName']) .'\')' ?>"><?= strtoupper($brand['groupName']) ?></a>
                <a style="cursor: default;text-decoration: none;" href="#" onclick=""> <?= strtoupper($brand['groupName']) ?></a>
            </div>
        <?php } ?>
        
        <?php if(count($sortedGroupList) <= 0){ ?>
            <div class="row"> No Brands </div>
        <?php } ?>
   
        <p class="search-result text-uppercase" style="margin-top: 1.5em;">SUGGESTIONS</p>
        
        <?php foreach($suggestion as $sugg){ ?>
            <div class="row" style="text-align: left;padding-left: 25px; overflow:hidden;">
                <a href="<?= Core::make('helper/navigation')->getLinkToCollection($sugg) ?>"><?= strtoupper(Loader::helper('text')->entities($sugg->getCollectionName())); ?></a>
                <a class="p-sugstn" href="" onclick="<?= 'suggestSearch(\''. str_replace(" ", "_", $sugg) .'\')' ?>"><?= $sugg ?></a>
            </div>
        <?php } ?>
        
        <?php if(count($suggestion) <= 0){ ?>
            <div class="row"> No Suggestions </div>
        <?php } ?>

    </div>
    <div class="col-md-9">
        <?php 
        if ($products) {
            foreach ($products as $product) {
                $imgObj = $product->getImageObj();
                $thumb = Core::make('helper/image')->getThumbnail($imgObj, 150, 140, true);
        ?>
            <div class="store-product-list-item_ajx col-md-3 col-sm-3 col-xs-6">
                <div class="product_item_ajx pro hvr-float">
                    <a href="<?= ($product->getAttribute('redirect_to_site') && $product->getAttribute('redirect_url') != '' ? $product->getAttribute('redirect_url') : \URL::to(Page::getByID($product->getPageID()))) ?>">
                        <img src="<?= $thumb->src ?>" class="img-responsive" alt="<?= $product->getName() ?>"/>
                    </a>                    
                </div>
                <a class="a_title_ajx" href="<?= ($product->getAttribute('redirect_to_site') && $product->getAttribute('redirect_url') != '' ? $product->getAttribute('redirect_url') : \URL::to(Page::getByID($product->getPageID()))) ?>">
                    <?= $product->getName(); ?>
                </a>
                <h6>
                <?php $salePrice = $product->getSalePrice();
                if (isset($salePrice) && $salePrice != "") {
                    ?>
                    <?= $product->getFormattedSalePrice() ?><span style="font-size: 14px;color: #000;text-transform: none;font-weight:normal;"> Ex VAT</span><br>';
//                   <span class="store-original-price" style="color: #999;font-size: 13px;text-decoration: line-through;"><?= $product->getFormattedOriginalPrice() ?></span>';
                <?php } else { ?>
                <?= $product->getFormattedPrice() ?><span style="font-size: 14px;color: #000;text-transform: none;font-weight:normal;"> Ex VAT</span>';
                <?php } ?>
                </h6>
            </div>        
        <?php  } ?>
        <div class="row mb-3"><div class="col-md-12"><button class="btn btn-primary" style="background-color: #ec7c05;border-color: #ec7c05;margin: 10px;" type="submit">View All results...</button></div></div>        
        
        <?php }else{ ?>
        
            <h4>No products were found !!! </h4>
        <?php } ?>
    </div>
</div>