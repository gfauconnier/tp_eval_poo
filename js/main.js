$('#vehiculesTable').stacktable();

$('tbody tr').click(function(){
  window.location.href = 'vehicule.php?id=' + this.id;
})
