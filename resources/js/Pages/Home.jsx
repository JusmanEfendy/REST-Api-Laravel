import React from "react";
import { Link, Head } from "@inertiajs/react";
import Navbar from "@/Components/Navbar";
import PostCard from "@/Components/Home/PostsCard";

export default function home(props) {
    return (
        <div className="min-h-screen bg-slate-100">
            <Head title={props.title} />
            <div>
                <Navbar props={props.auth.user}/>
                <PostCard posts={props.posts} />
            </div>
        </div>
    );
}