import { AiOutlineComment } from "react-icons/ai";
import React, { useState } from 'react';

const isPost = (posts) => {
    return posts.data.map((post, i) => {
        return (
            <div
                key={i}
                className="card w-auto bg-base-100 shadow-xl mt-4 ml-4 mr-5">
                <figure>
                    {post.image ? <img src={post.image} alt="Post" /> : null}
                </figure>
                <div className="card-body">
                    <h2 className="card-title">
                        {post.title}
                        <div className="badge badge-secondary">
                            diposting oleh : {post.author.username}
                        </div>
                    </h2>
                    <p>{post.news_content}</p>
                    <div className="card-actions justify-start mt-4">
                        <button
                            className="badge mt-5"
                            onClick={() => window.alert(`Jumlah  ${post.jumlah_komentar}`)}>
                            <AiOutlineComment size={25} />
                            {post.jumlah_komentar}
                        </button>
                        <div className="badge badge-inline mt-5">
                            dibuat: {post.created_at}
                        </div>
                    </div>
                </div>
            </div>
        );
    });
};

const noPosts = () => {
    return (
        <div className=" w-auto items-center text-center">
            Belum Ada Postingan
        </div>
    );
};

const PostCard = ({ posts }) => {
    if (!posts && posts == null) return noPosts();
    return isPost(posts);
};

const testAlert = "percobaan komentar"

export default PostCard;
