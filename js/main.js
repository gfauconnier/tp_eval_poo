// activates stacktable to home.php table
$('#vehiclesTable').stacktable();

// adds a link to tbody rows
$('tbody tr').click(function(){
  window.location.href = 'vehicle.php?id=' + this.id;
});

// adds class to text inputs and textareas when they're focused
$('form.modify_vehicle input, form.modify_vehicle textarea').focus(function(){
  $(this).addClass("focused");
});
// remove the previously added class when the focus is lost
$('form.modify_vehicle input, form.modify_vehicle textarea').focusout(function(){
  $(this).removeClass("focused");
});
