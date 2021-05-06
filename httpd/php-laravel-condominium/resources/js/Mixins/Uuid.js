let uuid = 0;

export default {    
  created () {
    if (!this.id) {
      this.uuid = uuid.toString();
      uuid += 1;
    }
  },
};
