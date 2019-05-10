package com.example.api.technicaltest.manager;

public interface Manager<E, ID> {
    public Iterable<E> findAll();

    public E findById(ID id);

    public E save(E e);

    public Iterable<E> saveAll(Iterable<E> e);

    public E update(E e);

    public void remove(E e);
}
