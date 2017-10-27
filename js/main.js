// activates stacktable to home.php table
$('#vehiculesTable').stacktable();

// adds a link to tbody rows
$('tbody tr').click(function(){
  window.location.href = 'vehicule.php?id=' + this.id;
});

// adds class to text inputs and textareas when they're focused
$('form.modify_vehicule input, form.modify_vehicule textarea').focus(function(){
  $(this).addClass("focused");
});
// remove the previously added class when the focus is lost
$('form.modify_vehicule input, form.modify_vehicule textarea').focusout(function(){
  $(this).removeClass("focused");
});
