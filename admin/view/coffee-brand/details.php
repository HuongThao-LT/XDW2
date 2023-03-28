<?php require_once('view/layout/header.php'); ?>
<!-- Start Content -->
<link rel="stylesheet" href="css/coffee-brand/details.css">
<div id="coffee-brand-details-content">
    <div id="coffee-brand-details-actions">
        <a class="btn btn-primary" href="<?=APP_URL?>admin/coffee-brand.php">Back</a>
        <div>
            <a class="btn btn-warning" href="<?=APP_URL?>admin/coffee-brand.php?action=edit&id=<?=$coffee_brand_details_id?>" >Edit</a>
            <button id="coffee-brand-details-delete-action" class="btn btn-danger">Delete</button>
        </div>
    </div>
    <h3 id="coffee-brand-details-title">COFFEE BRAND ID</h3>
    <div id="coffee-brand-details-info">
        <input type="hidden" id="coffee-brand-details-id" value=<?=$coffee_brand_details_id?>>
        <div class="form-group">
            Name: <span id="coffee-brand-details-name"></span>
        </div>
        <div class="form-group">
            Created At: <span id="coffee-brand-details-created_at"></span>
        </div>
        <div class="form-group">
            Updated At: <span id="coffee-brand-details-updated_at"></span>
        </div>
    </div>
</div>
<script src="js/coffee-brand/details.js"></script>
<!-- End Content -->
<?php require_once('view/layout/footer.php'); ?>