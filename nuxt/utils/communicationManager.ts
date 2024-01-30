
export default class Apiservices {

    private baseUrl = 'http://localhost:1337';

    private token: string = '6775fbd9a52e3b01566cbacb5785265c1352c5277e7bc25b896fcc915d54b6e8e39415308f80402f7cd8cf1189ae8114dbd8c858def0b9c02ff68e56f455432f3bb431d14340a37574a61333787680f270e8e51dff7e187912732354f0e0b4285b03b2373ff8232c3df84b40d4399f6852df82b3a071c675db881c3a9bdcbd77';

    private async fetchCall(url: string, method: string, body: any) {
        const response = await fetch(`${url}`, {
            method,
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${this.token}`
            },
            body: JSON.stringify(body)
        });
        return response.json();
    }
    async getLlibres() {

        return await this.fetchCall(`${this.baseUrl}/api/libros?populate=*`, 'GET');
    }

}

export const api = new Apiservices();
