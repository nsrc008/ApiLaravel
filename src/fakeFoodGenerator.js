import { faker } from '@faker-js/faker/locale/es';
import * as fs from 'node:fs';  

function generate_food() {
    let food = []
    for(let id = 1; id <=100; id++){
        const image = faker.image.urlLoremFlickr({ category: 'food' })
        const price = faker.commerce.price()
        const product = faker.commerce.product()
        const description = faker.commerce.productDescription()

        food.push({
            id: id,
            image: image,
            price: price,
            product: product,
            description: description
        })
    }
    return {data: food}
}

const DataGenerate = generate_food()
fs.writeFileSync('data.json', JSON.stringify(DataGenerate, null, "\t"))
