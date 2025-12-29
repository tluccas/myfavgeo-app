import { NextRequest, NextResponse } from "next/server";

export function middleware(req: NextRequest) {
    // Lê o cookie de authenticação
    const token = req.cookies.get('token');

    if (!token && req.nextUrl.pathname.startsWith('/maps')) {
        return NextResponse.redirect(new URL('/login', req.url));
    }
    return NextResponse.next();
}