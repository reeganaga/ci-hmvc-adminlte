<div class="modal fade in" id="<?php echo $id; ?>" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
           
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    
                </div>
   
            <?php if (!empty($body)): ?>
                <div class="modal-body">
                    <?php echo $body; ?>
                </div>
            <?php endif; ?>


        </div>
    </div>
</div>