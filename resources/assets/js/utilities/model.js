class Model {
    /**
     * Model class constructor.
     *
     * @param attributes
     */
    constructor(attributes) {
        _.forEach(attributes, (attribute, name) => {
            this[name] = attribute;
        });
    }

    /**
     * Get all items of the model
     *
     * @param params
     * @returns {Promise}
     */
    static all(params = null) {
        return new Promise((resolve, reject) => {
            axios
                .get(this.route(), {params: params})
                .then((response) => resolve(this.initCollection(response.data.data)))
                .catch((response) => reject(response));
        });
    }

    /**
     * Get an item of the model
     *
     * @param key
     * @param params
     * @returns {Promise}
     */
    static get(key, params = null) {
        return new Promise((resolve, reject) => {
            axios
                .get(this.route() + '/' + key, {params: params})
                .then((response) => resolve(this.initItem(response.data.data)))
                .catch((response) => reject(response));
        });
    }

    /**
     * Initialize a collection of items.
     *
     * @param collection
     */
    static initCollection(collection) {
        let initializedCollection = [];
        _.forEach(collection, (item) => {
            initializedCollection.push(this.init(item));
        });

        return initializedCollection;
    }

    /**
     * Initialize an item.
     *
     * @param item
     * @returns {*}
     */
    static initItem(item) {
        return this.init(item);
    }
}

export {Model as default};