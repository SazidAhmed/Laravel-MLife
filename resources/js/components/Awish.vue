<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <h4>Say About Your Life !!!</h4>

        <form action="#" @submit.prevent="edit ? updateWish(mywish.id) : createWish()">
          <div class="form-group">
            <label></label>
            <br />
            <input
              v-model="mywish.name"
              type="text"
              placeholder="Your Name Here"
              name="name"
              class="form-control"
            />
          </div>

          <div class="form-group">
            <label></label>
            <br />
            <textarea
              v-model="mywish.wish"
              name="wish"
              placeholder="Your Life Lines Here ..."
              class="form-control"
              rows="5"
              type="text"
            ></textarea>
          </div>

          <div class="form-group">
            <button v-show="!edit" type="submit" class="badge badge-pill badge-info">Add</button>
            <button v-show="edit" type="submit" class="badge badge-pill badge-info">Update</button>
          </div>
        </form>
      </div>

      <div class="col-sm-8">
        <h3>Wish List . . .</h3>
        <br />
        <!-- <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" 
                    class="page-item"><a class="page-link" href="#"
                    @click="fetchMywish(pagination.prev_page_url)">Previous</a></li>

                    <li class="page-item disabled"><a class="page-link text-dark" href="#">
                        Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>

                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" 
                    class="page-item"><a class="page-link" href="#"
                    @click="fetchMywish(pagination.next_page_url)">Next</a></li>
                </ul>
        </nav>-->
        <div class="list-group">
          <li
            class="list-group-item list-group-item-action flex-column align-items-start text-white bg-info"
            v-for="mywish in mywishs"
            :key="mywish.id"
          >
            <div class="d-flex w-100 justify-content-between">
              <p class="mb-1">Name : {{mywish.name}}</p>
            </div>
            <p class="mb-1">Life Lines : {{mywish.wish}}</p>
            <small>
              <button @click="showWish(mywish.id)" class="badge badge-pill badge-warning">Edit</button>
            </small>
            <small>
              <button @click="deleteWish(mywish.id)" class="badge badge-pill badge-danger">Delete</button>
            </small>
          </li>
        </div>
        <br />
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
              <a
                class="page-link text-white bg-info"
                href="#"
                @click="fetchMywish(pagination.prev_page_url)"
              >Previous</a>
            </li>

            <li class="page-item disabled">
              <a
                class="page-link text-white bg-info"
                href="#"
              >Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
            </li>

            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
              <a
                class="page-link text-white bg-info"
                href="#"
                @click="fetchMywish(pagination.next_page_url)"
              >Next</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      edit: false,
      mywishs: [],
      mywish: {
        id: "",
        name: "",
        wish: ""
      },
      mywish_id: "",
      pagination: {}
    };
  },
  mounted() {
    console.log("Component Loaded...");
    this.fetchMywish();
  },
  methods: {
    fetchMywish(page_url) {
      let vm = this;
      page_url = page_url || "http://localhost/mlife/public/api/mlife";
      console.log("fetching Data ...");
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          console.log(res.data);
          this.mywishs = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch(err => {
          console.log(err);
        });
    },

    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };
      this.pagination = pagination;
    },

    createWish() {
      console.log("creating data");
      let self = this;
      let params = Object.assign({}, self.mywish);
      axios
        .post("http://localhost/mlife/public/api/mlife", params)
        .then(() => {
          self.mywish.name = "";
          self.mywish.wish = "";
          self.edit = false;
          self.fetchMywish();
        })
        .catch(err => {
          console.log(err);
        });
    },
    //To show current data in form
    showWish(id) {
      let self = this;
      axios.get("http://localhost/mlife/public/api/mlife/" + id).then(res => {
        //showing data in form
        self.mywish.id = res.data.id;
        self.mywish.name = res.data.name;
        self.mywish.wish = res.data.wish;
      });
      self.edit = true;
    },

    updateWish(id) {
      console.log("Updating Data ID " + id + "...");
      let self = this;
      let params = Object.assign({}, self.mywish);
      axios
        .patch("http://localhost/mlife/public/api/mlife/" + id, params)
        .then(() => {
          self.mywish.name = "";
          self.mywish.wish = "";
          self.edit = false;
          self.fetchMywish();
        })
        .catch(err => {
          console.log(err);
        });
    },

    deleteWish(id) {
      console.log("Deleting Data ID " + id + "...");
      let self = this;
      axios
        .delete("http://localhost/mlife/public/api/mlife/" + id)
        .then(res => {
          self.fetchMywish();
        })
        .catch(err => {
          console.log(err);
        });
    }
  }
};
</script>