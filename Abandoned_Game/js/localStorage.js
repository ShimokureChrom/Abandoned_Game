//魔術師一覧
var requests = []
var newRequest = { name: "", cost: "", rank: "", time: "" }

var requestVue = new Vue({
  el: '#request',
  data: {
    requests: requests,
    newRequest: newRequest
  },
  computed: {
    canAdd: function () {
      let can = true
      can &= this.newRequest.name != ""
      can &= this.newRequest.cost != ""
      can &= this.newRequest.rank != ""
      can &= this.newRequest.time != ""
      return can
    }
  },
  methods: {
    addRequest: function () {
      let addData = { name: this.newRequest.name, cost: this.newRequest.cost, rank: this.newRequest.rank, time: this.newRequest.time }
      this.requests.push(addData)
      this.newRequest.name = ""
      this.newRequest.cost = ""
      this.newRequest.rank = ""
      this.newRequest.time = ""
      saveLocal("requests", this.requests);
    },
    deleteRequest: function (num) {
      this.requests.splice(num, 1)
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
