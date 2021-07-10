import { toRefs } from "vue";
import { Inertia } from "@inertiajs/inertia";

export function useDeleteRow(routeName) {

    const deleteRow = rowId => {
      if (confirm("¿Estás seguro de que quieres eliminar?")) {
        Inertia.delete(route(routeName, rowId));
      }
    }

    return { deleteRow };
    
}

export function useSearch(props, path) {

    const { rows, errors } = props;

    const { search, sort, direction } = toRefs(props);

    let searchDebounceTimer;
    const setSearch = (e) => {
      // clear previous searchDebounceTimer
      clearTimeout(searchDebounceTimer);

      // set new timer
      searchDebounceTimer = setTimeout(() => {
        load({ search: e.target.value });
      }, 300);
    };

    const setSort = (s) => { // "s" is abbreviation of "sort"
                             // reverse direction if clicked twice on column
      let d = "asc";         // "d" is abbreviation of "direction"
      if (sort.value == s) {
        d = direction.value == "asc" ? "desc" : "asc";
      }
      load({ direction: d, sort: s });
    };

    const load = (newParams) => {
      // mix defaults and new parameters
      const params = {
        search: search.value || "",
        sort: sort.value || "",
        direction: direction.value || "",
        ...newParams,
      };
      // convert obj into url
      const urlQuery = new URLSearchParams(params).toString();

      const url = `/${path}?${urlQuery}`;
      Inertia.get(url, [], {
        preserveState: true,
      });
    };

    return {      
      setSearch,
      setSort
    };

}

