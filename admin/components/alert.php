<?php if(isset($_SESSION['success'])) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>
            <i class="fas fa-check-circle"></i>
        </strong> 
        
        <?php echo $_SESSION['success']; ?>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

        <?php unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>

<?php if(isset($_SESSION['error'])) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>
            <i class="fas fa-exclamation-triangle"></i>
        </strong> 

        <?php echo $_SESSION['error']; ?>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>
