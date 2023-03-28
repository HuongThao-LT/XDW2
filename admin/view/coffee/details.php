<?php require_once('view/layout/header.php'); ?>
<!-- Start Content -->
<link rel="stylesheet" href="css/coffee/details.css">
<div id="coffee-details-content">
    <div id="coffee-details-actions">
        <a class="btn btn-primary" href="<?=APP_URL?>admin/coffee.php">Back</a>
        <div>
            <a class="btn btn-warning" href="<?=APP_URL?>admin/coffee.php?action=edit&id=<?=$coffee_details_id?>" >Edit</a>
            <button id="coffee-details-delete-action" class="btn btn-danger">Delete</button>
        </div>
    </div>
    <h3 id="coffee-details-title">COFFEE ID</h3>
    <div id="coffee-details-info">
        <input type="hidden" id="coffee-details-id" value=<?=$coffee_details_id?>>
        <div class="form-group coffee-detail-image-card">
            <img id="coffee-details-image"/>
        </div>
        <div class="form-group">
            Name: <span id="coffee-details-name"></span>
        </div>
        <div class="form-group">
            Status: <span id="coffee-details-status"></span>
        </div>
        <div class="form-group">
            Price: <span id="coffee-details-price"></span>
        </div>
        <div class="form-group">
            Type: <span id="coffee-details-type"></span>
        </div>
        <div class="form-group">
            Brand: <span id="coffee-details-brand"></span>
        </div>
        <div class="form-group">
            Description: 
            <div id="coffee-details-description"></div>
        </div>
        <div class="form-group">
            Created At: <span id="coffee-details-created_at"></span>
        </div>
        <div class="form-group">
            Updated At: <span id="coffee-details-updated_at"></span>
        </div>
    </div>
</div>
<script src="js/coffee/details.js"></script>
<!-- End Content -->
<?php require_once('view/layout/footer.php'); ?>