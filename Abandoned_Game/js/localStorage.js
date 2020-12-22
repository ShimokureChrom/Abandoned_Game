//魔術師一覧
var requests = []
var newRequest = ""

var requestVue = new Vue({
  el: '#request',
  data: {
    requests: requests,
    newRequest: newRequest
  },
  computed: {
    canAdd: function () {
      return this.newRequest != ""
    }
  },
  methods: {
    addRequest: function () {
      let addData = { name: this.newRequest }
      this.requests.push(addData)
      this.newRequest = ""
      saveLocal("requests", this.requests);
    }
  }
})

// 読込
function loadLocal(data_name) {
  if (localStorage.getItem(data_name))
    return JSON.parse(localStorage.getItem(data_name));
  return [];
}

function load_datas(data_name, toSet) {
  let storage = loadLocal(data_name);
  for (let i = 0; i < storage.length; i++)
    toSet.push(storage[i])
}

// 保存
function saveLocal(data_name, data) {
  localStorage.setItem(data_name, JSON.stringify(data))
}

//削除
function deleteLocal(data_name) {
  localStorage.setItem(data_name, "")
}

function delete_datas() {
  requestVue._data.requests = []
  deleteLocal("requests")
}

load_datas("requests", requests)
