import axios from "axios";

export const mostrarPosts = async function (url) {
    try {
        const response = await axios.get(url);
        const posts = response.data;
        const result = [];
        for (let i = 0; i < posts.length; i++) {

            const post = posts[i];

            const postJSON = {
                user: post.user,
                photo: post.profile,
                date: post.date,
                id_user: post.id_user,
                post: post.post,
            };

            let js = JSON.parse(post.data);
            postJSON.image = js.image,
                postJSON.text = js.text;
            result.push(postJSON);
        }
        return result;
    } catch (error) {
        console.error(error);
        return [];
    }
}


export const resultPosts = async (url) => {
    try {
        const data = await mostrarPosts(url);
        return data;
    } catch (error) {
        console.error(error);
        return [];
    }
}

