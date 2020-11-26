// 読込
function load(data_name) 
{
  if(localStorage.getItem(data_name)) 
    return JSON.parse(localStorage.getItem(data_name));   
  return [];  
}

function load_datas()
{
  let requests = load('requests');
  let conjureres = load('conjureres');
  let out_data = "";
  for(let i = 0; i < requests.length; i++)
  {
    out_data += requests[i];
    out_data += "<br>";
  }
  document.getElementById("requests_out").innerHTML = out_data;
  out_data = "";
  for(let i = 0; i < conjureres.length; i++)
  {
    out_data += conjureres[i];
    out_data += "<br>";
  }
  document.getElementById("conjureres_out").innerHTML = out_data;
}

// 保存
function save_request() 
{
  let requests = load('requests');
  let add = document.getElementById("request_name").value;
  if(add)
    requests.push(add);
  localStorage.setItem('requests', JSON.stringify(requests));
  load_datas();
}
function save_conjurer() 
{
  let conjureres = load('conjureres');
  let add = document.getElementById("conjurer_name").value;
  if(add)
    conjureres.push(add);
  localStorage.setItem('conjureres', JSON.stringify(conjureres));
  load_datas();
}