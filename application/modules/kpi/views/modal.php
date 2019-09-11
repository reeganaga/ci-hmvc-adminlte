<div class="modal fade modal-ajax" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
$('.modal-ajax').on('show.bs.modal',function(e){
    var button = $(e.relatedTarget)
    var title = button.data('title')

    var url = button.data('url')
    // replace title
    var modal = $(this);
    modal.find('.modal-title').html(title)
    
    //replace content
    $.ajax({
        type: "post",
        url: url,
        data: "data",
        dataType: "html",
        success: function (response) {
            modal.find('.modal-body').html(response)
        }
    });
    console.log('test');
})
</script>