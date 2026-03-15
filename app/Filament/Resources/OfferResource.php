<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfferResource\Pages;
use App\Filament\Resources\OfferResource\RelationManagers;
use App\Models\Offer;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfferResource extends Resource
{
    protected static ?string $model = Offer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('hospital_id')
                    ->relationship('hospital', 'name')
                    ->required()
                    ->label('المستشفى صاحب العرض'),
                TextInput::make('title')->required()->label('عنوان العرض'),
                TextInput::make('discount')->required()->label('نسبة الخصم'),
                TextInput::make('old_price')->numeric()->label('السعر القديم'),
                TextInput::make('new_price')->numeric()->required()->label('السعر الجديد'),
                Forms\Components\FileUpload::make('cover')->image()->directory('offers')->label('صورة العرض'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('discount')->sortable()->searchable(),
                TextColumn::make('old_price')->sortable()->searchable(),
                TextColumn::make('new_price')->sortable()->searchable(),
                TextColumn::make('hospital.name')->label('المستشفى')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOffers::route('/'),
            'create' => Pages\CreateOffer::route('/create'),
            'edit' => Pages\EditOffer::route('/{record}/edit'),
        ];
    }
}
