export interface get__usuario {
    id: number;
    nombre: string;
    passwrd: string;
    email: string;
    telefono: string;
    fecha_nacimiento: string;
    token: string;
}


export interface usuario_login {
    email: string;
    passwrd: string;
}


// ---------------------------------------------------------------------------

export interface User {
    id: number;
    username: string;
    email: string;
    password: string;
    firstName: string;
    lastName: string;
    image: string;
    token: string;
}

export interface login {

    username: string;
    password: string;

}

export interface Customer {
    id: number;
    firstName: string;
    lastName: string;
    maidenName: string;
    age: number;
    gender: string;
    email: string;
    phone: string;
    username: string;
    password: string;
    birthDate: Date;
    image: string;
    bloodGroup: string;
    height: number;
    weight: number;
    eyeColor: string;
    hair: Hair;
    domain: string;
    ip: string;
    address: Address;
    macAddress: string;
    university: string;
    bank: Bank;
    company: Company;
    ein: string;
    ssn: string;
    userAgent: string;
    crypto: Crypto;
}

export interface Address {
    address: string;
    city: string;
    coordinates: Coordinates;
    postalCode: string;
    state: string;
}

export interface Coordinates {
    lat: number;
    lng: number;
}

export interface Bank {
    cardExpire: string;
    cardNumber: string;
    cardType: string;
    currency: string;
    iban: string;
}

export interface Company {
    address: Address;
    department: string;
    name: string;
    title: string;
}

export interface Crypto {
    coin: string;
    wallet: string;
    network: string;
}

export interface Hair {
    color: string;
    type: string;
}
