<template>
  <div>
    <div class="input-group mb-3">
      <span
        id="basic-addon1"
        class="input-group-text search-icon"
      >
        <svg
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M20.71 19.29L17.31 15.9C18.407 14.5025 19.0022 12.7767 19 11C19 9.41775 18.5308 7.87103 17.6518 6.55544C16.7727 5.23985 15.5233 4.21447 14.0615 3.60897C12.5997 3.00347 10.9911 2.84504 9.43928 3.15372C7.88743 3.4624 6.46197 4.22433 5.34315 5.34315C4.22433 6.46197 3.4624 7.88743 3.15372 9.43928C2.84504 10.9911 3.00347 12.5997 3.60897 14.0615C4.21447 15.5233 5.23985 16.7727 6.55544 17.6518C7.87103 18.5308 9.41775 19 11 19C12.7767 19.0022 14.5025 18.407 15.9 17.31L19.29 20.71C19.383 20.8037 19.4936 20.8781 19.6154 20.9289C19.7373 20.9797 19.868 21.0058 20 21.0058C20.132 21.0058 20.2627 20.9797 20.3846 20.9289C20.5064 20.8781 20.617 20.8037 20.71 20.71C20.8037 20.617 20.8781 20.5064 20.9289 20.3846C20.9797 20.2627 21.0058 20.132 21.0058 20C21.0058 19.868 20.9797 19.7373 20.9289 19.6154C20.8781 19.4936 20.8037 19.383 20.71 19.29ZM5 11C5 9.81332 5.3519 8.65328 6.01119 7.66658C6.67047 6.67989 7.60755 5.91085 8.7039 5.45673C9.80026 5.0026 11.0067 4.88378 12.1705 5.11529C13.3344 5.3468 14.4035 5.91825 15.2426 6.75736C16.0818 7.59648 16.6532 8.66558 16.8847 9.82946C17.1162 10.9933 16.9974 12.1997 16.5433 13.2961C16.0892 14.3925 15.3201 15.3295 14.3334 15.9888C13.3467 16.6481 12.1867 17 11 17C9.4087 17 7.88258 16.3679 6.75736 15.2426C5.63214 14.1174 5 12.5913 5 11Z"
            fill="#919EAB"
          />
        </svg>
      </span>
      <input
        v-model="searchQuery"
        type="text"
        class="form-control custom-input"
        :placeholder="searchPlaceholder"
        aria-label="Username"
        aria-describedby="basic-addon1"
        @keyup.enter="handleSearch"
      >
    </div>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr class="border-grey-header">
            <th
              scope="col"
              class="bg-grey-header border-grey-header col-no text-secondary"
              @click="handleChangeSort"
            >
              <div class="d-flex is-align-items-center">
                <div class="d-flex justify-content-center align-items-center">
                  No
                </div>
                <div class="d-flex justify-content-center align-items-center">
                  <svg
                    :class="isAscending ? 'rotate-180' : 'rotate-0'"
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path 
                      d="M14.0775 10.02C14.0145 9.94406 13.9372 9.88128 13.8499 9.83527C13.7627 9.78925 13.6672 9.7609 13.5689 9.75185C13.4707 9.74279 13.3717 9.7532 13.2775 9.78249C13.1832 9.81177 13.0957 9.85935 13.02 9.9225L9.74996 12.645V3.75C9.74996 3.55109 9.67094 3.36032 9.53029 3.21967C9.38964 3.07902 9.19887 3 8.99996 3C8.80105 3 8.61028 3.07902 8.46963 3.21967C8.32898 3.36032 8.24996 3.55109 8.24996 3.75V12.645L4.97996 9.9225C4.90412 9.85947 4.81661 9.81199 4.72242 9.78277C4.62824 9.75356 4.52922 9.74318 4.43102 9.75223C4.33282 9.76129 4.23737 9.78959 4.15011 9.83554C4.06285 9.88148 3.9855 9.94416 3.92246 10.02C3.85943 10.0958 3.81195 10.1833 3.78273 10.2775C3.75352 10.3717 3.74314 10.4707 3.75219 10.5689C3.76125 10.6671 3.78956 10.7626 3.8355 10.8499C3.88144 10.9371 3.94412 11.0145 4.01996 11.0775L8.51996 14.8275L8.63246 14.895L8.72996 14.9475C8.90372 15.0145 9.0962 15.0145 9.26996 14.9475L9.36746 14.895L9.47996 14.8275L13.98 11.0775C14.0559 11.0145 14.1187 10.9372 14.1647 10.85C14.2107 10.7627 14.2391 10.6672 14.2481 10.569C14.2572 10.4707 14.2468 10.3717 14.2175 10.2775C14.1882 10.1833 14.1406 10.0958 14.0775 10.02Z" 
                      fill="#637381"
                    />
                  </svg>
                </div>
              </div>
            </th>
            <th
              v-for="(header, index) in headers"
              :key="index"
              scope="col"
              class="bg-grey-header border-grey-header col-header text-secondary col-max"
            >
              {{ header.name }}
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(row, rowIndex) in rows"
            :key="rowIndex"
            class="dotted-border-bottom"
          >
            <td class="col-no">
              {{ row.index }}
            </td>
            <td
              v-for="(header, colIndex) in headers"
              :key="colIndex"
              class="text-secondary-emphasis col-max"
              style="white-space: normal; word-break: break-word;"
            >
              {{ row[header.field] }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: "VTable",
  props: {
    headers: {
      type: Array,
      required: true
    },
    rows: {
      type: Array,
      required: true
    },
    page:{
      type: Number,
      required: true
    },
    limit:{
      type: Number,
      required: true
    },
    searchPlaceholder: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      searchQuery: '',
      isAscending: false
    }
  },
  methods: {
    handleSearch() {
      console.log(this.searchQuery)
      this.$emit('handleSearch', this.searchQuery);
    },
    handleChangeSort() {
      this.isAscending = !this.isAscending
      this.$emit('handleChangeSort', this.isAscending ? 'asc' : 'desc');
    },
  }
};
</script>

<style scoped>
.table { table-layout: fixed; }
.table-responsive{overflow-x: auto; -webkit-overflow-scrolling: touch;}
.col-max { width: 150px !important;}
.col-no {width: 60px;}
.bg-grey-header{ background:#F4F6F8 !important;}
.border-grey-header {border: 1px solid #F4F6F8 !important;}
.dotted-border-bottom {
  border-bottom: 1px dotted #F4F6F8;
}
.icon-search{
  border-right: none;
  border-radius: 4px 0px 0px 4px;
}
::v-deep .el-input__inner{padding-left: 50px !important;}
.rotate-180 {
  transform: rotate(180deg);
  transition: transform 0.3s ease;
}
.rotate-0 {
  transform: rotate(0deg);
  transition: transform 0.3s ease;
}
.search-icon {
  background-color: white;
  border-right: none !important
}

.custom-input {  border-left: none !important; border-color: none !important;}
.custom-input:focus {
  outline: none;
  box-shadow: none;
  border: 1px solid #ced4da !important;
  border-left: none !important;
}
</style>
