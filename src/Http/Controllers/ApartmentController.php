<?php

namespace Selene\Modules\ApartmentModule\Http\Controllers;

use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Selene\Modules\ApartmentModule\ApartmentModule;
use Selene\Modules\ApartmentModule\Http\Requests\ApartmentStoreRequest;
use Selene\Modules\ApartmentModule\Http\Requests\ApartmentUpdateRequest;
use Selene\Modules\ApartmentModule\Models\Apartment;
use Selene\Modules\ApartmentModule\Support\CsvDataImporter;
use Selene\Modules\ApartmentModule\Support\StorageAdapter;
use Selene\Modules\ApartmentModule\Support\ApartmentStatusesEnum;
use Selene\Modules\DashboardModule\ZdrojowaTable;

/**
 * Class ApartmentController
 * @package Selene\Modules\ApartmentModule\Http\Controllers
 */
class ApartmentController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        return view('ApartmentModule::list', ['statuses' => ApartmentStatusesEnum::toArray()]);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('ApartmentModule::add', ['statuses' => ApartmentStatusesEnum::toArray()]);
    }

    /**
     * @param ApartmentStoreRequest $request
     *
     * @param Apartment $apartment
     *
     * @return RedirectResponse
     */
    public function store(ApartmentStoreRequest $request, Apartment $apartment)
    {
        $path = StorageAdapter::saveFile($request->file('photo_file'), ApartmentModule::imagesUriPath());
        $request->merge(['image_uri' => $path]);

        $path = StorageAdapter::saveFile($request->file('pdf_file'), ApartmentModule::pdfUriPath());
        $request->merge(['pdf_uri' => $path]);

        $apartment->create($request->all());

        $request->session()->flash('alert-success', 'Apartament dodano poprawnie.');

        return redirect()->back();
    }

    /**
     * @param Apartment $apartment
     *
     * @return Factory|View
     */
    public function edit(Apartment $apartment)
    {
        return view('ApartmentModule::edit', [
            'apartment' => $apartment,
            'statuses' => ApartmentStatusesEnum::toArray(),
        ]);
    }

    /**
     * @param ApartmentUpdateRequest $request
     * @param Apartment $apartment
     *
     * @return RedirectResponse
     */
    public function update(ApartmentUpdateRequest $request, Apartment $apartment)
    {
        if ($request->has('photo_file')) {
            $path = StorageAdapter::saveFile($request->file('photo_file'), ApartmentModule::imagesUriPath());

            $request->merge(['image_uri' => $path]);
        }

        if ($request->has('pdf_file')) {
            $path = StorageAdapter::saveFile($request->file('pdf_file'), ApartmentModule::pdfUriPath());

            $request->merge(['pdf_uri' => $path]);
        }

        $apartment->update($request->all());

        $request->session()->flash('alert-success', 'Apartament zaktualizowano poprawnie.');

        return redirect()->back();
    }

    /**
     * @param Apartment $apartment
     *
     * @throws Exception
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function ajax(Request $request)
    {
        return ZdrojowaTable::response(Apartment::query(), $request);
    }

    /**
     * @return Factory|View
     */
    public function import()
    {
        return view('ApartmentModule::import');
    }

    /**
     * @param Request $request
     *
     * @param Apartment $apartment
     *
     * @return Factory|View
     */
    public function importStore(Apartment $apartment, Request $request)
    {
        $csvData = CsvDataImporter::prepareDataFrom($request->file('csv'));

        $apartment->storeData($csvData);

        return redirect()->route('ApartmentModule::apartments');
    }
}

