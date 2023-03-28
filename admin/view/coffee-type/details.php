<?php require_once('view/layout/header.php'); ?>
<!-- Start Content -->
<link rel="stylesheet" href="css/coffee-type/details.css">
<div id="coffee-type-details-content">
    <div id="coffee-type-details-actions">
        <a class="btn btn-primary" href="<?=APP_URL?>admin/coffee-type.php">Back</a>
        <div>
            <a class="btn btn-warning" href="<?=APP_URL?>admin/coffee-type.php?action=edit&id=<?=$coffee_type_details_id?>" >Edit</a>
            <button id="coffee-type-details-delete-action" class="btn btn-danger">Delete</button>
        </div>
    </div>
    <h3 id="coffee-type-details-title">COFFEE TYPE ID</h3>
    <div id="coffee-type-details-info">
        <input type="hidden" id="coffee-type-details-id" value=<?=$coffee_type_details_id?>>
        <div class="form-group">
            Name: <span id="coffee-type-details-name"></span>
        </div>
        <div class="form-group">
            Created At: <span id="coffee-type-details-created_at"></span>
        </div>
        <div class="form-group">
            Updated At: <span id="coffee-type-details-updated_at"></span>
        </div>
    </div>
</div>
<script src="js/coffee-type/details.js"></script>
<!-- End Content -->
<?php require_once('view/layout/footer.php'); ?>