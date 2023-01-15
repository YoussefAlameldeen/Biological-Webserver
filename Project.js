function validation()
{
  var id = document.getElementById('GID').value;
  if(id==null)
  {
    alert("You Should Enter The Sequence ID!");
  }
  var seq_name=document.getElementById('GName').value;
  if(seq_name=="")
  {
    alert("You Should Enter The Name of The Gene!");
  }
  var sequence = document.getElementById('sequence').value;
  if(sequence=="")
  {
    alert("You Should Enter the sequence to perform processes on it!");
  }
  if(sequence.length<8)
  {
    alert("You Should Enter A Longer Sequence!")
  }
  var seq_type= document.querySelector('input[name="seq_type"]:checked');
  if(seq_type==null)
  {
    alert("You Should select The Type of The Sequence!");
  }
  



}