// 読込
function load(data_name) {
  if (localStorage.getItem(data_name))
    return JSON.parse(localStorage.getItem(data_name));
  return [];
}

function load_datas() {
  let requests = load('requests');
  let conjureres = load('conjureres');
  var requests_out = new Vue({ el: '#requests_out', data: { requests: [] } });
  var conjureres_out = new Vue({ el: '#conjureres_out', data: { conjureres: [] } });
  for (let i = 0; i < requests.length; i++)
    requests_out.requests.push({ text: requests[i] });
  for (let i = 0; i < conjureres.length; i++)
    conjureres_out.conjureres.push({ text: conjureres[i] });
}

// 保存
function save_request() {
  let requests = load('requests');
  let add = document.getElementById("request_name").value;
  if (add)
    requests.push(add);
  localStorage.setItem('requests', JSON.stringify(requests));
  load_datas();
}
function save_conjurer() {
  let conjureres = load('conjureres');
  let add = document.getElementById("conjurer_name").value;
  if (add)
    conjureres.push(add);
  localStorage.setItem('conjureres', JSON.stringify(conjureres));
  load_datas();
}

//削除
function delete_datas() {
  localStorage.setItem('requests', "");
  localStorage.setItem('conjureres', "");
  load_datas();
}
