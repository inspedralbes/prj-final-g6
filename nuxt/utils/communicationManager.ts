export default class Apiservices {

    private baseUrl = 'http://localhost:1337';

    private token: string = '79a584043d6a67545e5d94912cf3d58c64c99aee00a9235f34a567ce84c41ea3ef9219fbf15743ec2f12f83afe1fabfd17962a70c65e519c3c3debe48e73442cb46f8f47ebad967f812ad36e4b1bdbc877431b4903a972c2c2123aae0141c3d573ced74c7767f676b8b5d8689445224664dad510480c6d468477e5624c310d9a';

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
    async getDiscotecas() {
        return await this.fetchCall(`${this.baseUrl}/api/Discotecas?populate=*`, 'GET');
    }

    async createDiscoteca(infoDiscoteca) {
        return await this.fetchCall(`${this.baseUrl}/api/Discotecas`, 'POST', infoDiscoteca);
      }

    async deleteDiscoteca(id) {
        return await this.fetchCall(`${this.baseUrl}/api/Discotecas/${id}`, 'DELETE');
      }

}

export const api = new Apiservices();

