<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HospitalResource\Pages;
use App\Filament\Resources\HospitalResource\RelationManagers;
use App\Models\Hospital;
use App\Models\Major;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HospitalResource extends Resource
{
    protected static ?string $model = Hospital::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('location')->required(),
                Select::make('majors') // اسم العلاقة التي عرفناها في الموديل
                    ->relationship('majors', 'name') // اسم العلاقة، والعمود الذي سيظهر في القائمة (الاسم)
                    ->multiple() // هذا السطر يسمح لك باختيار أكثر من تخصص للمستشفى الواحد
                    ->preload() // لتحميل البيانات مسبقاً وسهولة البحث داخل القائمة
                    ->searchable() // يضيف مربع بحث داخل القائمة
                    ->label('Majors'), // لتغيير اسم الحقل في الفورم'),
                TextInput::make('info')->required(),
                FileUpload::make('cover')->disk('public')->directory('hospitals'),
                Toggle::make('is_active')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('location')->searchable()->sortable(),
                TextColumn::make('info'),
                ImageColumn::make('cover')->disk('public'),
                TextColumn::make('active_status')->label('Status'),
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
            'index' => Pages\ListHospitals::route('/'),
            'create' => Pages\CreateHospital::route('/create'),
            'edit' => Pages\EditHospital::route('/{record}/edit'),
        ];
    }
}
