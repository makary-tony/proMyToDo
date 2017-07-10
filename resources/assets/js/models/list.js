import Model from '../utilities/model';

class List extends Model
{
    /**
     * Get the base route for the model.
     *
     * @returns {string}
     */
    static route() {
        return '/api/list';
    }

    /**
     * Get the model form data.
     *
     * @returns {{name: string, description: string, level: string}}
     */
    static data() {
        return {
            name: '',
        }
    }

    /**
     * Initialize a user.
     *
     * @param attributes
     * @returns {User}
     */
    static init(attributes) {
        return new List(attributes);
    }

    /**
     * Get the date formatted.
     *
     * @returns {*}
     */
    getCreatedDateFormatted() {
        return moment(this.created_at.data).toNow();
    }
}

export {List as default};