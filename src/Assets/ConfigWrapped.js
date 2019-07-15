class ConfigWrapped {

	constructor() {
		this.configs = {};
	}

	/**
	 * @param {string} name
	 * @param { Config } config
	 */
	addConfig(name, config) {
		this.configs[name] = new config();
	}

	getConfigByName(name) {
		if (this.configs[name]) {
			return this.configs[name];
		}
		return undefined;
	}

}

export let Wrapped = new ConfigWrapped();
