$(document).ready((function(){var o=this,e=$(".table-language");e.on("click",".delete-locale-button",(function(o){o.preventDefault(),$(".delete-crud-entry").data("url",$(o.currentTarget).data("url")),$(".modal-confirm-delete").modal("show")})),$(document).on("click",".delete-crud-entry",(function(t){t.preventDefault(),$(".modal-confirm-delete").modal("hide");var a=$(t.currentTarget).data("url");$(o).prop("disabled",!0).addClass("button-loading"),$.ajax({url:a,type:"POST",data:{_method:"DELETE"},success:function(t){t.error?Woo.showError(t.message):(t.data&&(e.find("i[data-locale="+t.data+"]").unwrap(),$(".tooltip").remove()),e.find('a[data-url="'+a+'"]').closest("tr").remove(),Woo.showSuccess(t.message)),$(o).prop("disabled",!1).removeClass("button-loading")},error:function(e){$(o).prop("disabled",!1).removeClass("button-loading"),Woo.handleError(e)}})})),$(document).on("click",".add-locale-form button[type=submit]",(function(o){var t=this;o.preventDefault(),o.stopPropagation(),$(this).prop("disabled",!0).addClass("button-loading"),$.ajax({type:"POST",cache:!1,url:$(this).closest("form").prop("action"),data:new FormData($(this).closest("form")[0]),contentType:!1,processData:!1,success:function(o){o.error?Woo.showError(o.message):(Woo.showSuccess(o.message),e.load(window.location.href+" .table-language > *")),$(t).prop("disabled",!1).removeClass("button-loading")},error:function(o){$(t).prop("disabled",!1).removeClass("button-loading"),Woo.handleError(o)}})}));var t=$("#available-remote-locales");if(t.length){var a=function(){$.ajax({url:t.data("url"),type:"GET",success:function(o){o.error?Woo.showError(o.message):(e.load(window.location.href+" .table-language > *"),t.html(o.data))},error:function(o){Woo.handleError(o)}})};a(),$(document).on("click",".btn-import-remote-locale",(function(o){o.preventDefault(),$(".button-confirm-import-locale").data("url",$(this).data("url")),$(".modal-confirm-import-locale").modal("show")})),$(".button-confirm-import-locale").on("click",(function(o){o.preventDefault();var e=$(o.currentTarget);e.addClass("button-loading");var t=e.data("url");$.ajax({url:t,type:"POST",success:function(o){o.error?Woo.showError(o.message):(Woo.showSuccess(o.message),a()),e.closest(".modal").modal("hide"),e.removeClass("button-loading")},error:function(o){Woo.handleError(o),e.removeClass("button-loading")}})}))}}));