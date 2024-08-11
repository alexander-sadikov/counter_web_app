export enum HttpMethod{
    GET = 'GET',
    POST = 'POST',
    PUT = 'PUT',
    DELETE = 'DELETE'
}

type ServerErrorResponseType = {
    message: string
}

export class HttpUtils {
    public static async appFetch(method: HttpMethod, url: string, data = {}, signal: AbortSignal | null = null): Promise<any> {
        let response = await fetch(url, {
            method,
            body: JSON.stringify(data),
            signal,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            }
        })
        {}

        if(response.ok){
            return await response.json();
        }else{
            let errorMsg = (await response.json() as ServerErrorResponseType).message;

            throw new Error(errorMsg ?? 'Unexpected error');
        }
    }
}