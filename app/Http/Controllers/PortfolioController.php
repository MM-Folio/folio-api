<?php

namespace App\Http\Controllers;

use App\Http\Resources\Artist\ArtistIndexResource;
use App\Http\Resources\Portfolio\PortfolioDTO;
use App\Http\Resources\Portfolio\PortfolioIndexResource;
use App\Http\Resources\Portfolio\PortfolioResource;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::query()->paginate(20);
        
        return response()->json([
            "portfolios" => PortfolioIndexResource::collection($portfolios),
            "pagination" => [
                "total_portfolios" => $portfolios->total(),
                "current_page" => $portfolios->currentPage(),
                "total_pages" => $portfolios->lastPage(),
                "first_page" => $portfolios->url(1),
                "last_page" => $portfolios->url($portfolios->lastPage()),
                "prev_page" => $portfolios->previousPageUrl(),
                "next_page" => $portfolios->nextPageUrl(),
            ],
        ]);
    }

    public function show($urlId)
    {
        $id = base64_decode($urlId);
        $id = str_replace("view", "", $id);
        $portfolio = Portfolio::find($id);

        if($portfolio->valid_till ?? '1900-01-01' >= date('Y-m-d')) {
            return response()->json([
                new PortfolioDTO($portfolio)], 200);
        } else {
            return response()->json([
                'message' => 'Portfolio not found!'], 404);
        }

        
    }

    public function edit($id)
    {
        $portfolio = Portfolio::find($id);

        if(!$portfolio) {
            return response()->json([
                'message' => 'Portfolio not found!'
            ], 404);
        }

        return response()->json([
            'title' => $portfolio->title,
            'valid_till' => $portfolio->valid_till,
        ]);
    }

    public function store(Request $request)
    {
        $portfolio = Portfolio::create([
            ...$request->validate([
                'title' => ['required', 'string', 'max:255'],
                'valid_till' => ['required', 'date'],
            ]),
            'urlId' => 'empty',
        ]);
        $portfolio->urlId = base64_encode("view" . $portfolio->id);
        $portfolio->save();

        return response()->json([
            'message' => 'Portfolio created!',
        'redirect' => route('portfolio.edit', ['id' => $portfolio->id])], 201);
    }

    public function update(Request $request, $id)
    {
        $portfolio = Portfolio::find($id);

        if(!$portfolio) {
            return response()->json([
                'message' => 'Portfolio not found!'
            ], 404);
        }

        $portfolio->update([
            ...$request->validate([
                'title' => ['required', 'string', 'max:255'],
                'valid_till' => ['required', 'date'],
                
            ])
        ]);

        return response()->json([
            'message' => 'Portfolio updated!',
        'redirect' => route('portfolio.edit', ['id' => $portfolio->id])], 200);
    }

    public function destroy($id)
    {
        Portfolio::destroy($id);

        return response()->json([
            'message' => 'Portfolio deleted!'], 200);
    }

    public function getPortfolioArtists($id)
    {
        $portfolio = Portfolio::find($id);

        return response()->json([
            "id" => $portfolio->id,
            "title" => $portfolio->title,
            "artists" => ArtistIndexResource::collection($portfolio->artists),
        ]);
    }

    public function addPortfolioArtist($id, $artistId)
    {
        $portfolio = Portfolio::find($id);

        $portfolio->artists()->attach($artistId);

        return response()->json([
            'message' => 'Artist added to portfolio!'], 200);
    }

    public function removePortfolioArtist($id, $artistId)
    {
        $portfolio = Portfolio::find($id);

        $portfolio->artists()->detach($artistId);

        return response()->json([
            'message' => 'Artist removed from portfolio!'], 200);
    }
}
