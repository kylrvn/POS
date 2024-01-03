$(document).ready(function () {
});

// loads modal content of cards
$(document).on("click", ".task-name", function () {
  $(document).gmLoadPage({
    url: "kanban/load_order",
    data: { post: $(this).data("orderid") },
    load_on: "#load_order",
  });
});

//viewing of modal pic
$(document).on("click", "#view_mockup", function () {
  $("#view_modal").modal("show");
});

//enables editing of fields
$(document).on("click", "#update_dets", function () {
  $("#load_order :input").prop("disabled", false);
  $(this).css("display", "none"); //hides update button
  $("#cancel").css("display", "inline"); //shows cancel and save button
  $("#save_dets").css("display", "inline");
});

//cancels edit and reverts to update button
$(document).on("click", "#cancel", function () {
  $(this).css("display", "none");
  $("#save_dets").css("display", "none");
  $("#load_order :input:not(:button):not(#modal_reqs)").prop("disabled", true);
  $("#update_dets").css("display", "inline");
});

$(document).on('click', '#save_dets', function() {
  $.post({
      url: base_url + 'payment/service/Payment_service/update_details',
      data: {
          Order_id: $(this).data('oid'),
          Order_status: $('#o_status').val(),
          Sewer: $('#sewer').val(),
          Lay_artist: $('#layout').val(),
          Set_artist: $('#setup').val(),
          b_note: $('#b_note').val(),
          d_note: $('#d_note').val(),
          freebies: $('#freebies').val(),
          d_date: $('#deadline_date').val(),
      },
      success: function(e) {
          var e = JSON.parse(e);
          if (e.has_error == false) {
              toastr.success(e.message);
              $('.select_update').attr('disabled', 'disabled');
              $('#d_date').attr('disabled', 'disabled');
              $('.note_area').attr('disabled', 'disabled');
              $('#update_dets').css('display', 'inline');
              $('#save_dets').css('display', 'none');
              $('#cancel').css('display', 'none');
              setTimeout(function() {
                  window.location.reload();
              }, 2000);


          } else {
              toastr.error(e.message);
          }
      },
  })

});

$(document).on('click', '#submit_req', function() {
  var formData = new FormData($("#uploadForm")[0]);
  var cid = $(this).data('name');
  var oid = $(this).data('oid');

  $.ajax({
      url: baseUrl + 'payment/service/Payment_service/save_modal_req?cid=' + cid + '&oid=' + oid,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
          var parsedResponse = JSON.parse(response);
          if (parsedResponse.has_error == false) {
              toastr.success("Document(s) Successfully uploaded.");
              setTimeout(function() {
                  window.location.reload();
              }, 2000);
          } else {
              toastr.error("ERROR");
          }
      },
      error: function(xhr, status, error) {
          console.error(error);
      }
  });
  // setTimeout(function() {
  //     window.location.reload();
  // }, 500);
});
//-------- DRAG AND DROP FUNCTIONALITIES ----------//
var cards = document.querySelectorAll(".card-task");
var list = document.querySelectorAll(".card-holder");

cards.forEach((cards) => {
  cards.addEventListener("dragstart", () => {
    cards.classList.add("dragging");
  });
  // sean palautokg
  cards.addEventListener("dragend", () => {
    cards.classList.remove("dragging");
    const cardID = cards.dataset.cardId;
    const listID = getListID(cards);
    console.log(listID + "-" + cardID);

    const order = getCardOrder(listID, cardID);
    console.log("Card Order:", order);

    $.post({
      url: "kanban/service/Kanban_service/update_card",
      // selector: '.form-control',
      data: {
        card: cardID,
        stat: listID,
        order: order,
      },
      success: function (e) {
        var e = JSON.parse(e);
        if (e.has_error == false) {
          toastr.success("Cards Updated");
        } else {
          toastr.error(
            "There's an issue with the connection to the server. Please try again."
          );
        }
      },
    });
  });
});

list.forEach((list) => {
  list.addEventListener("dragover", (e) => {
    e.preventDefault();
    const afterElement = getDragAfterElement(list, e.clientY);
    const card_drag = document.querySelector(".dragging");
    list.appendChild(card_drag);
    if (afterElement == null) {
      list.appendChild(card_drag);
    } else {
      list.insertBefore(card_drag, afterElement);
    }
  });
});

function getDragAfterElement(list, y) {
  const draggableElements = [
    ...list.querySelectorAll(".card-task:not(.dragging)"),
  ];

  return draggableElements.reduce(
    (closest, child) => {
      const box = child.getBoundingClientRect();
      const offset = y - box.top - box.height / 2;
      if (offset < 0 && offset > closest.offset) {
        return { offset: offset, element: child };
      } else {
        return closest;
      }
    },
    { offset: Number.NEGATIVE_INFINITY }
  ).element;
}

function getListID(element) {
  const list = element.closest(".card-holder");
  return list ? list.dataset.statid : null;
}

function getCardOrder(listID, draggedCardID) {
  const list = document.querySelector(`.card-holder[data-statID="${listID}"]`);
  const cards = list.querySelectorAll(".card-task");
  const newOrder = Array.from(cards).findIndex(
    (card) => card.dataset.cardId === draggedCardID
  );
  return newOrder + 1;
}

//-------- END DRAG AND DROP FUNCTIONALITIES ----------//

//displaying adding of input
$(".kcol").on("click", ".btn-add-card", function () {
  var kcol = $(this).closest(".kcol");

  if (kcol.find(".kcol-body .card-inpt").length === 0) {
    if (kcol.find(".card-inpt").length === 0) {
      // Create a new textarea element
      var textarea = $("<textarea>", {
        class: "card-inpt",
        dir: "auto",
        placeholder: "Enter a title for this card…",
        style: "height: 74px;",
      });

      var addtaskbtn = $("<button>", {
        class: "btn btn-add-task",
        type: "button",
        style: "color: white; font-weight: 600;",
        html: "Add task",
      });

      // Create a new cancel button
      var cancelButton = $("<button>", {
        class: "btn btn-cancel-card",
        type: "button",
        html:
          '<span data-testid="CloseIcon" aria-hidden="true" class="css-snhnyn" style="--icon-primary-color: var(--ds-text-accent-gray-bolder, #172B4D); --icon-secondary-color: inherit;">' +
          '<svg width="24" height="24" role="presentation" focusable="false" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">' +
          '<path fill-rule="evenodd" clip-rule="evenodd" d="M10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12Z" fill="white"></path>' +
          "</svg></span>",
      });

      // Append the textarea and cancel button to the kcol-body div
      kcol.find(".card-holder").append(textarea);
      kcol.find(".kcol-footer").append(addtaskbtn);
      kcol.find(".kcol-footer").append(cancelButton);
    }
  }
  $(this).hide();
});

//return to default if editing
$(document).on("click", function (e) {
  cancel_card(e);
});

const cancel_card = (e) => {
  var target = $(e.target);
  // console.log(target);
  if (!target.closest(".kcol, .card-inpt").length) {
    $(".card-inpt").remove();
    $(".btn-cancel-card").remove();
    $(".btn-add-task").remove();
    $(".btn-add-card").show();
  }
};

const cancel_cardv2 = (kcol) => {
  console.log("v2");
  kcol.find(".card-inpt, .btn-cancel-card").remove();
  kcol.find(".btn-add-card").show();
};

$(".kcol").on("click", ".btn-cancel-card", function () {
  var kcol = $(this).closest(".kcol");
  cancel_cardv2(kcol);
});

$(".kcol").on("click", ".btn-add-task", function () {
  const statID = $(this).closest(".kcol").data("stat");
  var kcol = $(this).closest(".kcol");

  $.post({
    url: "kanban/service/Kanban_service/save_card",
    // selector: '.form-control',
    data: {
      status_ID: statID,
      card: $(".card-inpt").val(),
    },
    success: function (e) {
      var e = JSON.parse(e);
      if (e.has_error == false) {
        toastr.success(e.message);
        cancel_cardv2(kcol);
      } else {
        toastr.error(e.message);
        cancel_cardv2(kcol);
      }
    },
  });
});

//end if return to default

//code from other asset
$(document).on("click", "#s_customer", function () {
  $("#n_customer_form").css("display", "none");
  $("#s_customer_form").css("display", "block");
  $(".cust_details").css("display", "block");
});

// SAVE CUSTOMER DETAILS
$("#save_customer").click(function () {
  $.post({
    url: "customer/service/Customer_service/save",
    // selector: '.form-control',
    data: {
      FName: $("#FName").val(),
      LName: $("#LName").val(),
      Company: $("#Company").val(),
      CNumber: $("#CNumber").val(),
      Branch: $("#Branch").val(),
    },
    success: function (e) {
      var e = JSON.parse(e);
      if (e.has_error == false) {
        $(".inpt").attr("disabled", "disabled");
        $("#c_order").css("display", "inline");
        $("#submit_customer").css("display", "none");
        $("#modal-default").modal("hide");
        $("#FName").attr("class", "form-control inpt");
        $("#Company").attr("class", "form-control inpt");
        toastr.success(e.message);

        $("#c_order").click(function () {
          window.location.href = "create_order/index/" + e.cust_id;
        });
      } else {
        $("#FName").attr("class", "form-control inpt is-invalid");
        $("#Company").attr("class", "form-control inpt is-invalid");
        $("#modal-default").modal("hide");
        toastr.error(e.message);
      }
    },
  });
});

var load_orders = () => {
  $(document).gmLoadPage({
    url: "customer/get_orders?id=" + $("#search_customer").val(),
    load_on: "#load_orders",
  });
};

var x;

// DISPLAY SEARCHED CUSTOMER
$("#search_customer").change(function () {
  load_orders();
  $.post({
    url: "customer/get_cust_details",
    // selector: '.form-control',
    data: {
      Cust_id: $(this).val(),
    },
    success: function (e) {
      var e = JSON.parse(e);
      $("#FName_v").val(e.FName);
      $("#LName_v").val(e.LName);
      $("#Company_v").val(e.Company);
      $("#CNumber_v").val(e.CNumber);
      $("#Branch_v").val(e.Branch);
      $("#ID_v").val(e.ID);
      $("#edit_customer").attr("disabled", false);
      $("#c_order_2").attr("disabled", false);

      $("#c_order_2").click(function () {
        window.location.href = "create_order/index/" + e.ID;
      });

      // CANCEL EDIT CUSTOMER DETAILS
      $("#cancel_edit_customer").click(function () {
        toastr.warning("Update Cancelled");
        $("#FName_v").val(e.FName);
        $("#LName_v").val(e.LName);
        $("#Company_v").val(e.Company);
        $("#CNumber_v").val(e.CNumber);
        $("#Branch_v").val(e.Branch);

        $(".inpt_edit").attr("disabled", "disabled");
        $("#cancel_edit_customer").css("display", "none");
        $("#save_edit_customer").css("display", "none");
        $("#edit_customer").css("display", "inline");
        $("#c_order_2").css("display", "inline");
      });
    },
  });
});

// EDIT CUSTOMER DETAILS
$("#edit_customer").click(function () {
  $(".inpt_edit").attr("disabled", false);
  $("#cancel_edit_customer").css("display", "inline");
  $("#save_edit_customer").css("display", "inline");
  $(this).css("display", "none");
  $("#c_order_2").css("display", "none");
});

// SAVE CHANGES
$("#save_edit_customer").click(function () {
  $.post({
    url: "customer/service/Customer_service/update",
    // selector: '.form-control',
    data: {
      ID: $("#ID_v").val(),
      FName: $("#FName_v").val(),
      LName: $("#LName_v").val(),
      Company: $("#Company_v").val(),
      CNumber: $("#CNumber_v").val(),
      Branch: $("#Branch_v").val(),
    },
    success: function (e) {
      var e = JSON.parse(e);
      if (e.has_error == false) {
        toastr.success(e.message);
        $(".inpt_edit").attr("disabled", "disabled");
        $("#cancel_edit_customer").css("display", "none");
        $("#save_edit_customer").css("display", "none");
        $("#edit_customer").css("display", "block");
      } else {
        $("#FName_v").attr("class", "form-control inpt is-invalid");
        $("#Company_v").attr("class", "form-control inpt is-invalid");
        toastr.error(e.message);
      }
    },
  });
});

// function myFunction(e,x){
//     window.location.href = "point_of_sale/payment/?custid="+x+'&oid='+e;
// }

function myFunction(e, x) {
  // use this for local
  window.location.href =
    base_url + "point_of_sale/payment/?custid=" + x + "&oid=" + e;

  // use this for hosting
  // window.location.href = base_url+"payment/?custid="+x+'&oid='+e;
}
